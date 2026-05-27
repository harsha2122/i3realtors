<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'location',
        'event_date', 'event_time', 'total_capacity',
        'available_seats', 'images', 'status', 'sort_order',
    ];

    protected $casts = [
        'images'     => 'array',
        'event_date' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('event_date');
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->event_date ? $this->event_date->format('d M Y') : '';
    }

    public function getSeatsStatusAttribute(): string
    {
        if (is_null($this->available_seats) || is_null($this->total_capacity)) return '';
        if ($this->available_seats <= 0) return 'Sold Out';
        return $this->available_seats . ' / ' . $this->total_capacity . ' Available';
    }
}
