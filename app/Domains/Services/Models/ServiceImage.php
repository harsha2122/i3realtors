<?php

namespace App\Domains\Services\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceImage extends Model
{
    protected $fillable = [
        'service_id',
        'image',
        'order',
    ];

    public $timestamps = false;

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
