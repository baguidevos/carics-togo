<?php

namespace App\Models;

use Filament\Forms\Components\RichEditor\FileAttachmentProviders\SpatieMediaLibraryFileAttachmentProvider;
use Filament\Forms\Components\RichEditor\Models\Concerns\InteractsWithRichContent;
use Filament\Forms\Components\RichEditor\Models\Contracts\HasRichContent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class News extends Model implements HasMedia, HasRichContent
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use InteractsWithRichContent;

    public array $translatable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'location',
    ];

    public function setUpRichContent(): void
    {
        $this->registerRichContent('content')
            ->fileAttachmentProvider(
                SpatieMediaLibraryFileAttachmentProvider::make()
                    ->collection('news_attachments')
            );
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']);

        $this->addMediaCollection('news_attachments');
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

    public function getCoverImageUrl(?string $conversion = null): ?string
    {
        if ($this->hasMedia('cover')) {
            $media = $this->getFirstMedia('cover');
            if ($conversion && $media && $media->hasGeneratedConversion($conversion)) {
                return $media->getUrl($conversion);
            }

            return $media?->getUrl();
        }

        return $this->cover_image ? asset($this->cover_image) : null;
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        return $this->getCoverImageUrl();
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->getCoverImageUrl();
    }

    protected $table = 'news';

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'cover_image',
        'event_date', 'location',
        'category_id', 'blog_post_id',
        'published_date', 'is_featured', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'published_date' => 'date',
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

    /**
     * Catégorie — relation polymorphique côté enfant.
     * La catégorie correspondante a categorizable_type = 'App\Models\News'.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /** Article de blog complet auquel cette actualité renvoie */
    public function relatedBlogPost(): BelongsTo
    {
        return $this->belongsTo(BlogPost::class, 'blog_post_id');
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

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderBy('published_date', 'desc');
    }
}
