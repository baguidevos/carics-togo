<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class HeroSlide extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    public array $translatable = [
        'badge',
        'title',
        'description',
        'primary_cta_label',
        'secondary_cta_label',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('large')
            ->width(1920)
            ->height(1080)
            ->format('webp')
            ->quality(85)
            ->nonQueued();
    }

    public function getImageUrlAttribute(): ?string
    {
        if ($this->hasMedia('image')) {
            return $this->getFirstMediaUrl('image');
        }

        return $this->image ? (str_starts_with($this->image, 'http') ? $this->image : asset($this->image)) : null;
    }

    protected $fillable = [
        'badge',
        'title',
        'description',
        'image',
        'primary_cta_label',
        'primary_cta_url',
        'primary_cta_icon',
        'secondary_cta_label',
        'secondary_cta_url',
        'secondary_cta_icon',
        'display_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'display_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderBy('id');
    }
}
