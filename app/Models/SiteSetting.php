<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Paramètres globaux du site éditables via FilamentPHP.
 *
 * Usage dans Blade :
 *   {{ SiteSetting::get('mission_text') }}
 *   {{ SiteSetting::get('phone_1', '+228 00 00 00 00') }}
 *
 * Usage en PHP :
 *   SiteSetting::set('hero_title', 'Nouveau titre');
 */
class SiteSetting extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']);

        $this->addMediaCollection('favicon')
            ->singleFile()
            ->acceptsMimeTypes(['image/x-icon', 'image/png', 'image/svg+xml', 'image/vnd.microsoft.icon']);
    }

    protected $fillable = [
        'group', 'key', 'value', 'type', 'label', 'display_order',
    ];

    // ─── Helpers statiques ───────────────────────────────────────────────────

    /**
     * Récupère une valeur par sa clé avec mise en cache permanente.
     * Le cache est invalidé automatiquement à chaque modification.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever(
            "site_setting_{$key}",
            fn () => static::where('key', $key)->value('value') ?? $default
        );
    }

    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("site_setting_{$key}");
    }

    protected static function booted(): void
    {
        static::saved(fn (self $s) => Cache::forget("site_setting_{$s->key}"));
        static::deleted(fn (self $s) => Cache::forget("site_setting_{$s->key}"));
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeOfGroup(Builder $query, string $group): Builder
    {
        return $query->where('group', $group)->orderBy('display_order');
    }
}
