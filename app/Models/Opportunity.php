<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'category_id', 'description', 'requirements',
        'location', 'contract_type',
        'deadline', 'application_email', 'application_url',
        'status', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'requirements' => 'array',
            'deadline' => 'date',
            'is_published' => 'boolean',
        ];
    }

    // ─── Relations ───────────────────────────────────────────────────────────

    /**
     * Catégorie — relation polymorphique côté enfant.
     * La catégorie correspondante a categorizable_type = 'App\Models\Opportunity'.
     * Exemples : "Emploi & Consultance", "Stage & Mentorat", "Bourse", "Partenariat".
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeOpen(Builder $query): Builder
    {
        return $query
            ->where('status', 'ouverte')
            ->where('is_published', true);
    }

    public function scopeExpiringSoon(Builder $query, int $days = 14): Builder
    {
        return $query
            ->where('status', 'ouverte')
            ->whereBetween('deadline', [now(), now()->addDays($days)]);
    }

    public function scopeOfContractType(Builder $query, string $type): Builder
    {
        return $query->where('contract_type', $type);
    }
}
