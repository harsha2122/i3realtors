<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavigationItem extends Model
{
    protected $fillable = [
        'menu_id',
        'parent_id',
        'label',
        'url',
        'route_name',
        'icon',
        'is_external',
        'target_attribute',
        'is_visible',
        'order',
        'attributes',
    ];

    protected $casts = [
        'is_external' => 'boolean',
        'is_visible' => 'boolean',
        'order' => 'integer',
        'attributes' => 'json',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(NavigationMenu::class, 'menu_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavigationItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(NavigationItem::class, 'parent_id')->orderBy('order');
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function getUrl()
    {
        if ($this->is_external || !empty($this->url)) {
            return $this->url;
        }

        if (!empty($this->route_name)) {
            try {
                return route($this->route_name);
            } catch (\Exception $e) {
                return '#';
            }
        }

        return '#';
    }

    public function hasChildren(): bool
    {
        return $this->children()->exists();
    }
}
