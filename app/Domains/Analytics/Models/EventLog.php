<?php

namespace App\Domains\Analytics\Models;

use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
    protected $fillable = [
        'event_type',
        'entity_type',
        'entity_id',
        'user_id',
        'changes',
        'ip_address',
        'created_at',
    ];

    public $timestamps = false;

    protected $casts = [
        'changes' => 'json',
        'created_at' => 'datetime',
    ];
}
