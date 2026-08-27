<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class BlogPost extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    public array $translatable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'meta_title',
        'meta_description',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']);

        $this->addMediaCollection('body_attachments');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(600)
            ->height(400)
            ->format('webp')
            ->quality(80)
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(1200)
            ->height(800)
            ->format('webp')
            ->quality(85)
            ->nonQueued();
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('cover') ?: ($this->cover_image ? asset($this->cover_image) : null);
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_image_url;
    }

    /**
     * Retourne la collection de médias pour le slider (galerie + couverture en fallback)
     */
    public function getSliderMedia()
    {
        $gallery = $this->getMedia('gallery');
        if ($gallery->isNotEmpty()) {
            return $gallery;
        }

        $attachments = $this->getMedia('body_attachments')->filter(function ($media) {
            return str_starts_with($media->mime_type ?? '', 'image/');
        });

        if ($attachments->isNotEmpty()) {
            return $attachments;
        }

        return $this->getMedia('cover');
    }

    protected $fillable = [
        'title', 'slug', 'type', 'excerpt', 'body', 'cover_image',
        'hero_media_type',
        'author_id', 'category_id', 'research_project_id',
        'reading_time_minutes', 'references',
        'meta_title', 'meta_description',
        'status', 'published_at', 'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'references' => 'array',
            'published_at' => 'datetime',
            'is_featured' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug(Str::limit($model->title, 80, ''));
            }
            // Calcul automatique du temps de lecture si non renseigné
            if (empty($model->reading_time_minutes) && $model->body) {
                $words = str_word_count(strip_tags($model->body));
                $model->reading_time_minutes = max(1, (int) ceil($words / 200));
            }
        });
    }

    // ─── Relations ───────────────────────────────────────────────────────────

    /** Auteur (membre de l'équipe) */
    public function author(): BelongsTo
    {
        return $this->belongsTo(TeamMember::class, 'author_id');
    }

    /**
     * Catégorie — relation polymorphique côté enfant.
     * La catégorie correspondante a categorizable_type = 'App\Models\BlogPost'.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /** Projet de recherche lié (optionnel) */
    public function researchProject(): BelongsTo
    {
        return $this->belongsTo(ResearchProject::class);
    }

    /** Tags */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_blog_tag');
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('status', 'publie')
            ->where('published_at', '<=', now());
    }

    public function scopeArticles(Builder $query): Builder
    {
        return $query->where('type', 'article');
    }

    public function scopeProjectSheets(Builder $query): Builder
    {
        return $query->where('type', 'fiche_projet');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeRecent(Builder $query, int $days = 90): Builder
    {
        return $query->where('published_at', '>=', now()->subDays($days));
    }
}
