<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

/**
 * Catégorie polymorphique.
 *
 * Le champ `categorizable_type` contient le FQCN du modèle propriétaire.
 * Une même table catégorise BlogPost, Resource, Opportunity et News.
 *
 * Usage Filament :
 *   Category::forModel(BlogPost::class)->pluck('name', 'id')
 *
 * La relation polymorphique inverse (categorizable) permet de retrouver
 * le "propriétaire" conceptuel d'un groupe de catégories, mais en pratique
 * c'est toujours via les relations HasMany ci-dessous qu'on navigue.
 */
class Category extends Model
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = [
        'name',
        'slug',
        'description',
    ];

    protected $fillable = [
        'name', 'slug', 'color_class', 'description',
        'categorizable_type', 'display_order',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    // ─── Relation polymorphique inverse ──────────────────────────────────────

    /**
     * Retourne le modèle "propriétaire" de ce type de catégorie.
     * Ex : $category->categorizable → instance de BlogPost (logique)
     *
     * Note : cette relation est principalement utile pour la navigation
     * sémantique. Dans le CRUD Filament, on utilise scopeForModel().
     */
    public function categorizable(): MorphTo
    {
        return $this->morphTo();
    }

    // ─── Relations HasMany vers chaque modèle enfant ─────────────────────────

    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }

    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    public function opportunities(): HasMany
    {
        return $this->hasMany(Opportunity::class);
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    /**
     * Filtre les catégories destinées à un modèle donné.
     * Usage : Category::forModel(BlogPost::class)->get()
     */
    public function scopeForModel(Builder $query, string $modelClass): Builder
    {
        return $query->where('categorizable_type', $modelClass);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderBy('name');
    }
}
