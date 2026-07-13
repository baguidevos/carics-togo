<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_type', 'full_name', 'email', 'organisation', 'subject',
        'message', 'file_path', 'meta',
        'is_read', 'is_archived',
    ];

    protected function casts(): array
    {
        return [
            'meta'        => 'array',
            'is_read'     => 'boolean',
            'is_archived' => 'boolean',
        ];
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('is_read', false);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_archived', false);
    }

    public function scopeOfType(Builder $query, string $formType): Builder
    {
        return $query->where('form_type', $formType);
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }
}