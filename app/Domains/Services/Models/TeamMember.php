<?php

namespace App\Domains\Services\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TeamMember extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'position',
        'department',
        'bio',
        'email',
        'phone',
        'linkedin_url',
        'profile_image',
        'status',
        'order',
        'joining_date',
    ];

    protected $casts = [
        'joining_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(TeamSkill::class, 'team_member_skill')
            ->withPivot('proficiency');
    }

    public function socials(): BelongsToMany
    {
        return $this->belongsToMany(TeamSocial::class, 'team_member_social')
            ->withPivot('url');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByDepartment($query, $department)
    {
        return $query->where('department', $department);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
