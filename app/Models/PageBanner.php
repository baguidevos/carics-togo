<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class PageBanner extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    public array $translatable = [
        'title',
        'subtitle',
        'breadcrumb_title',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('large')
            ->width(1920)
            ->height(800)
            ->format('webp')
            ->quality(85)
            ->nonQueued();
    }

    public function getImageUrlAttribute(): ?string
    {
        if ($this->hasMedia('cover')) {
            return $this->getFirstMediaUrl('cover');
        }

        return $this->image ? (str_starts_with($this->image, 'http') ? $this->image : asset($this->image)) : null;
    }

    public function getSliderImages(): array
    {
        $gallery = $this->getMedia('gallery');
        if ($gallery->isNotEmpty()) {
            return $gallery->map(fn (Media $m) => $m->getUrl())->values()->all();
        }

        $coverUrl = $this->image_url;

        return $coverUrl ? [$coverUrl] : [];
    }

    public static function forPage(string $pageKey): ?self
    {
        return static::where('page_key', $pageKey)->where('is_active', true)->first();
    }

    protected $fillable = [
        'page_key',
        'title',
        'subtitle',
        'breadcrumb_title',
        'hero_media_type',
        'image',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
