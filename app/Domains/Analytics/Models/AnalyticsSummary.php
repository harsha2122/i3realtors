<?php

namespace App\Domains\Analytics\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsSummary extends Model
{
    protected $fillable = [
        'date',
        'page_views',
        'unique_visitors',
        'conversion_count',
        'conversion_rate',
        'top_pages',
        'traffic_sources',
    ];

    public $timestamps = false;

    protected $casts = [
        'date' => 'date',
        'top_pages' => 'json',
        'traffic_sources' => 'json',
    ];
}
