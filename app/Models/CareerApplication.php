<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerApplication extends Model
{
    protected $fillable = [
        'career_job_id', 'job_title', 'full_name', 'email',
        'phone', 'experience_years', 'cover_letter', 'resume_path', 'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function job()
    {
        return $this->belongsTo(CareerJob::class, 'career_job_id');
    }
}
