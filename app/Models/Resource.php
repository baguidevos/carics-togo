<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'category_id',
        'file_path', 'external_url', 'status', 'display_order',
    ];

    // ─── Relations ───────────────────────────────────────────────────────────

    /**
     * Catégorie — relation polymorphique côté enfant.
     * La catégorie correspondante a categorizable_type = 'App\Models\Resource'.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', 'disponible');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderBy('title');
    }
}