<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasAuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory, HasSlug, HasAuditLog;

    protected $fillable = [
        'title', 'slug', 'short_description', 'description',
        'price', 'price_label', 'price_type',
        'type', 'status',
        'area', 'area_unit', 'bedrooms', 'bathrooms', 'floors',
        'location', 'city', 'state', 'google_maps_url',
        'thumbnail',
        'meta_title', 'meta_description',
        'is_featured', 'is_active', 'sort_order',
        'created_by',
    ];

    protected $casts = [
        'price'       => 'decimal:2',
        'area'        => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    // ── Relationships ──────────────────────────────────────────────────

    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class)->orderBy('sort_order');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ── Scopes ─────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOfStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeInCity($query, string $city)
    {
        return $query->where('city', $city);
    }

    public function scopeSearch($query, string $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('location', 'like', "%{$term}%")
              ->orWhere('city', 'like', "%{$term}%")
              ->orWhere('short_description', 'like', "%{$term}%");
        });
    }

    // ── Accessors ──────────────────────────────────────────────────────

    public function getThumbnailUrlAttribute(): string
    {
        return $this->thumbnail
            ? asset('uploads/' . $this->thumbnail)
            : asset('images/project-image-1.jpg');
    }

    public function getFormattedPriceAttribute(): string
    {
        if ($this->price_label) {
            return $this->price_label;
        }
        if ($this->price) {
            return '₹' . number_format($this->price);
        }
        return 'Price on Request';
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'available'         => 'success',
            'under_construction'=> 'warning',
            'coming_soon'       => 'info',
            'sold'              => 'secondary',
            default             => 'secondary',
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return ucfirst(str_replace('_', ' ', $this->type));
    }

    public function getStatusLabelAttribute(): string
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }
}
