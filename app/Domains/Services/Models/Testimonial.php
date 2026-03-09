<?php

namespace App\Domains\Services\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'author_name',
        'author_title',
        'company',
        'author_image',
        'company_logo',
        'content',
        'rating',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_featured' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('status', 'active');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }
}
