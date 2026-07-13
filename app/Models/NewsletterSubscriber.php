<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'preferences', 'is_active',
        'unsubscribe_token', 'subscribed_at',
    ];

    protected function casts(): array
    {
        return [
            'preferences'   => 'array',
            'is_active'     => 'boolean',
            'subscribed_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->unsubscribe_token)) {
                $model->unsubscribe_token = Str::random(40);
            }
            if (empty($model->subscribed_at)) {
                $model->subscribed_at = now();
            }
        });
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /** Abonnés intéressés par un thème donné */
    public function scopeInterestedIn(Builder $query, string $topic): Builder
    {
        return $query->whereJsonContains('preferences', $topic);
    }
}