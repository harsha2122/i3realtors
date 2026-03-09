<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavigationMenu extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'position',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(NavigationItem::class, 'menu_id');
    }

    public function rootItems(): HasMany
    {
        return $this->items()->whereNull('parent_id')->orderBy('order');
    }

    public function activeItems(): HasMany
    {
        return $this->items()->where('is_visible', true)->orderBy('order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBySlug($query, string $slug)
    {
        return $query->where('slug', $slug);
    }

    public function scopeByPosition($query, string $position)
    {
        return $query->where('position', $position);
    }

    public function getMenuTree()
    {
        return $this->rootItems()
            ->with('children')
            ->get()
            ->toArray();
    }
}
