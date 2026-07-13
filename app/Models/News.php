<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'cover_image',
        'category_id', 'blog_post_id',
        'published_date', 'is_featured', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'published_date' => 'date',
            'is_featured'    => 'boolean',
            'is_published'   => 'boolean',
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