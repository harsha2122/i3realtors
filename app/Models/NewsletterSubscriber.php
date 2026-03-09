<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $fillable = [
        'email',
        'verified_at',
        'unsubscribed_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->whereNotNull('verified_at')
            ->whereNull('unsubscribed_at');
    }
}
