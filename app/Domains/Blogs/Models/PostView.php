<?php

namespace App\Domains\Blogs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostView extends Model
{
    protected $fillable = [
        'post_id',
        'ip_address',
        'user_agent',
        'referer',
        'created_at',
    ];

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
