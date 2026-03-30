<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundRaisingLogo extends Model
{
    protected $fillable = ['logo', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('id');
    }
}
