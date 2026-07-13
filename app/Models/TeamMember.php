<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class TeamMember extends Model
{
    use HasFactory;

    // ─── Attributs ───────────────────────────────────────────────────────────

    protected $fillable = [
        'full_name', 'slug', 'role_title', 'role_category',
        'bio_short', 'bio_full', 'mission_text',
        'expertises', 'education', 'distinctions', 'affiliations',
        'photo', 'avatar_color',
        'email', 'linkedin_url', 'orcid_url', 'google_scholar_url',
        'is_founder', 'is_published', 'display_order',
    ];

    protected function casts(): array
    {
        return [
            'expertises'   => 'array',
            'education'    => 'array',   // [{degree, field, institution}, ...]
            'distinctions' => 'array',   // [{title, organisation, year}, ...]
            'affiliations' => 'array',   // ["RTI International", ...]
            'is_founder'   => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    // ─── Hooks ───────────────────────────────────────────────────────────────

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->full_name);
            }
        });
    }

    // ─── Relations ───────────────────────────────────────────────────────────

    /** Articles de blog rédigés par ce membre */
    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }

    /** Projets dont ce membre est l'investigateur principal */
    public function ledProjects(): HasMany
    {
        return $this->hasMany(ResearchProject::class, 'lead_id');
    }

    /** Projets auxquels ce membre est associé (via pivot) */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            ResearchProject::class,
            'research_project_team_member'
        )->withPivot('role_on_project')->withTimestamps();
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFounders(Builder $query): Builder
    {
        return $query->where('is_founder', true);
    }

    public function scopeBureauExecutif(Builder $query): Builder
    {
        return $query->where('role_category', 'bureau_executif');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderBy('full_name');
    }

    // ─── Accesseurs ──────────────────────────────────────────────────────────

    /** Initiales pour l'avatar de substitution (ex. "GK") */
    public function getInitialsAttribute(): string
    {
        $parts = preg_split('/\s+/', trim($this->full_name));
        return implode('', array_map(
            fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)),
            array_slice($parts, 0, 2)
        ));
    }
}