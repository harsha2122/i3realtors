<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerJob extends Model
{
    protected $fillable = [
        'title', 'category', 'employment_type', 'location',
        'experience', 'description', 'responsibilities', 'requirements',
        'status', 'sort_order',
    ];

    protected $casts = [
        'responsibilities' => 'array',
        'requirements'     => 'array',
    ];

    public function applications()
    {
        return $this->hasMany(CareerApplication::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('created_at');
    }
}
