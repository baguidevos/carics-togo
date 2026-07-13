<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'type', 'abstract',
        'journal_or_publisher', 'author_ids', 'external_co_authors',
        'file_path', 'external_url',
        'published_date', 'research_project_id', 'status',
    ];

    protected function casts(): array
    {
        return [
            'author_ids'     => 'array',  // [1, 4] → IDs de team_members
            'published_date' => 'date',
        ];
    }

    // ─── Relations ───────────────────────────────────────────────────────────

    public function researchProject(): BelongsTo
    {
        return $this->belongsTo(ResearchProject::class);
    }

    /**
     * Membres auteurs résolus depuis author_ids (pas de pivot dédié car
     * l'ordre des auteurs est significatif en publication scientifique).
     *
     * @return \Illuminate\Database\Eloquent\Collection<TeamMember>
     */
    public function authors()
    {
        return TeamMember::whereIn('id', $this->author_ids ?? [])
            ->orderByRaw('FIELD(id, ' . implode(',', $this->author_ids ?? [0]) . ')')
            ->get();
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'publie');
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderBy('published_date', 'desc');
    }
}