<?php

namespace App\Domains\Leads\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'source',
        'status',
        'assigned_to',
        'property_id',
        'notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function interactions(): HasMany
    {
        return $this->hasMany(LeadInteraction::class);
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'assigned_to');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeBySource($query, $source)
    {
        return $query->where('source', $source);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);
    }

    public function addNote(string $note, ?int $userId = null): LeadInteraction
    {
        return $this->interactions()->create([
            'type' => 'note',
            'content' => $note,
            'user_id' => $userId,
        ]);
    }

    public function addInteraction(string $type, string $content, ?int $userId = null): LeadInteraction
    {
        return $this->interactions()->create([
            'type' => $type,
            'content' => $content,
            'user_id' => $userId,
        ]);
    }

    public function updateStatus(string $status, ?int $userId = null): void
    {
        $this->update(['status' => $status]);
        $this->addInteraction('status_change', "Status changed to {$status}", $userId);
    }
}
