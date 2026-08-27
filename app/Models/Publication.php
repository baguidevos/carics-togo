<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Publication extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    public array $translatable = [
        'title',
        'abstract',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('document')
            ->singleFile()
            ->acceptsMimeTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);

        $this->addMediaCollection('cover')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function getDocumentUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('document') ?: ($this->file_path ? asset($this->file_path) : null);
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('cover') ?: null;
    }

    protected $fillable = [
        'title', 'type', 'abstract',
        'journal_or_publisher', 'author_ids', 'external_co_authors',
        'file_path', 'external_url',
        'published_date', 'research_project_id', 'status',
    ];

    protected function casts(): array
    {
        return [
            'author_ids' => 'array',  // [1, 4] → IDs de team_members
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
     * @return Collection<int, TeamMember>
     */
    public function authors()
    {
        $ids = $this->author_ids ?? [];

        if (empty($ids)) {
            return TeamMember::query()->whereRaw('1 = 0')->get();
        }

        return TeamMember::whereIn('id', $ids)
            ->get()
            ->sortBy(fn (TeamMember $member) => array_search($member->id, $ids))
            ->values();
    }

    public function getCitationAttribute(): string
    {
        $authorNames = [];
        foreach ($this->authors() as $author) {
            $authorNames[] = $author->full_name;
        }

        if ($this->external_co_authors) {
            $authorNames[] = $this->external_co_authors;
        }

        $authorsStr = ! empty($authorNames) ? implode(', ', $authorNames) : 'CARICS-Togo';
        $year = $this->published_date ? $this->published_date->format('Y') : date('Y');
        $journal = $this->journal_or_publisher ? " *{$this->journal_or_publisher}*" : '';
        $url = $this->external_url ? " {$this->external_url}" : '';

        return "{$authorsStr} ({$year}). {$this->title}.{$journal}.{$url}";
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
