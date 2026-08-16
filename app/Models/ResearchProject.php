<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ResearchProject extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('documents');
        $this->addMediaCollection('content_attachments');
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('cover') ?: null;
    }

    protected $fillable = [
        'title', 'slug', 'status', 'funder',
        'start_date', 'end_date', 'country', 'region',
        'intervention_zones', 'map_lat', 'map_lng',
        'context', 'objective', 'methodology',
        'expected_results', 'research_domains',
        'lead_id', 'is_featured', 'is_published', 'display_order',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'intervention_zones' => 'array',
            'expected_results' => 'array',
            'research_domains' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug(Str::limit($model->title, 80, ''));
            }
        });
    }

    // ─── Relations ───────────────────────────────────────────────────────────

    /** Investigateur principal */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(TeamMember::class, 'lead_id');
    }

    /** Équipe projet (pivot avec rôle) */
    public function teamMembers(): BelongsToMany
    {
        return $this->belongsToMany(
            TeamMember::class,
            'research_project_team_member'
        )->withPivot('role_on_project')->withTimestamps();
    }

    /** Partenaires et financeurs associés */
    public function partners(): BelongsToMany
    {
        return $this->belongsToMany(
            Partner::class,
            'partner_research_project'
        )->withTimestamps();
    }

    /** Articles de blog liés (articles + fiches projets) */
    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }

    /** Publications scientifiques produites par ce projet */
    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOngoing(Builder $query): Builder
    {
        return $query->where('status', 'en_cours');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderBy('start_date', 'desc');
    }

    /** Filtre par statut : scopeStatus($query, 'en_cours') */
    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }
}
