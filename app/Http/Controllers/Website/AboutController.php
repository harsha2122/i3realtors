<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Domains\Services\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::active()->ordered()->get();
        return view('website.about', compact('teamMembers'));
    }
}
