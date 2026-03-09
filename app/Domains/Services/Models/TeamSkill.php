<?php

namespace App\Domains\Services\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TeamSkill extends Model
{
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function teamMembers(): BelongsToMany
    {
        return $this->belongsToMany(TeamMember::class, 'team_member_skill')
            ->withPivot('proficiency');
    }
}
