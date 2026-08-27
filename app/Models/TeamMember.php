<?php

namespace App\Models;

use Filament\Forms\Components\RichEditor\FileAttachmentProviders\SpatieMediaLibraryFileAttachmentProvider;
use Filament\Forms\Components\RichEditor\Models\Concerns\InteractsWithRichContent;
use Filament\Forms\Components\RichEditor\Models\Contracts\HasRichContent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class TeamMember extends Model implements HasMedia, HasRichContent
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use InteractsWithRichContent;

    public array $translatable = [
        'role_title',
        'bio_short',
        'bio_full',
        'bio_quote',
        'mission_text',
        'current_position',
    ];

    public function setUpRichContent(): void
    {
        $this->registerRichContent('bio_full')
            ->fileAttachmentProvider(
                SpatieMediaLibraryFileAttachmentProvider::make()
                    ->collection('bio_attachments')
            );
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']);

        $this->addMediaCollection('bio_attachments');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->format('webp')
            ->quality(80)
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->width(600)
            ->height(600)
            ->format('webp')
            ->quality(85)
            ->nonQueued();
    }

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('avatar') ?: ($this->attributes['photo'] ?? null);
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->avatar_url;
    }

    // ─── Attributs ───────────────────────────────────────────────────────────

    protected $fillable = [
        'full_name', 'slug', 'role_title', 'role_category',
        'bio_short', 'bio_full', 'bio_quote', 'mission_text',
        'current_position', 'related_project_slug',
        'expertises', 'education', 'distinctions', 'affiliations',
        'photo', 'avatar_color',
        'email', 'linkedin_url', 'orcid_url', 'google_scholar_url',
        'is_founder', 'is_published', 'display_order',
    ];

    protected function casts(): array
    {
        return [
            'expertises' => 'array',
            'education' => 'array',   // [{degree, field, institution}, ...]
            'distinctions' => 'array',   // [{title, organisation, year}, ...]
            'affiliations' => 'array',   // ["RTI International", ...]
            'is_founder' => 'boolean',
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
        $parts = preg_split('/\s+/', trim($this->full_name ?? ''));

        return implode('', array_map(
            fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)),
            array_slice($parts, 0, 2)
        ));
    }

    public function getImageNameAttribute(): ?string
    {
        return $this->photo;
    }

    public function getFullNameAttribute(): ?string
    {
        return $this->attributes['full_name'] ?? null;
    }

    public function getRoleTitleAttribute(): ?string
    {
        return $this->attributes['role_title'] ?? null;
    }

    public function getBioShortAttribute(): ?string
    {
        return $this->attributes['bio_short'] ?? null;
    }

    public function setBioFullAttribute(mixed $value): void
    {
        if (is_array($value)) {
            $this->attributes['bio_full'] = implode('', array_map(fn ($p) => '<p>'.$p.'</p>', $value));
        } else {
            $this->attributes['bio_full'] = $value;
        }
    }

    public function getBioFullAttribute(): ?string
    {
        $val = $this->attributes['bio_full'] ?? null;
        if (empty($val)) {
            return null;
        }

        if (is_string($val) && (str_starts_with(trim($val), '[') || str_starts_with(trim($val), '{'))) {
            $decoded = json_decode($val, true);
            if (is_array($decoded)) {
                // Si c'est un tableau de paragraphes
                if (array_is_list($decoded) && isset($decoded[0]) && is_string($decoded[0])) {
                    return implode('', array_map(fn ($p) => '<p>'.htmlspecialchars($p).'</p>', $decoded));
                }
            }
        }

        return is_string($val) ? $val : null;
    }

    public function getBioParagraphsAttribute(): array
    {
        $bio = $this->bio_full;
        if (empty($bio)) {
            return [];
        }

        // Si contient des balises <p>
        if (preg_match_all('/<p>(.*?)<\/p>/is', $bio, $matches)) {
            return $matches[1];
        }

        return array_filter(explode("\n", strip_tags($bio)));
    }

    public function getBioQuoteAttribute(): ?string
    {
        return $this->attributes['bio_quote'] ?? null;
    }

    public function getMissionTextAttribute(): ?string
    {
        return $this->attributes['mission_text'] ?? null;
    }

    public function getIsFounderAttribute(): bool
    {
        return (bool) ($this->attributes['is_founder'] ?? false);
    }

    public function getRelatedProjectSlugAttribute(): ?string
    {
        return $this->attributes['related_project_slug'] ?? null;
    }

    public function getAvatarColorAttribute(): string
    {
        return $this->attributes['avatar_color'] ?? 'primary';
    }

    public function getLinksAttribute(): array
    {
        return [
            'email' => $this->email,
            'linkedin' => $this->linkedin_url,
            'orcid' => $this->orcid_url,
            'googleScholar' => $this->google_scholar_url,
        ];
    }
}
