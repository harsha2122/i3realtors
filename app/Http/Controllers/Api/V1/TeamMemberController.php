<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\Services\Models\TeamMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TeamMemberController extends Controller
{
    public function index(): JsonResponse
    {
        $members = TeamMember::active()->ordered()->with('skills', 'socials')->get();
        return response()->json($members);
    }

    public function show(TeamMember $member): JsonResponse
    {
        return response()->json($member->load('skills', 'socials'));
    }

    public function byDepartment(string $department): JsonResponse
    {
        $members = TeamMember::active()->byDepartment($department)->ordered()->with('skills', 'socials')->get();
        return response()->json($members);
    }
}
