<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Domains\Services\Models\TeamMember;
use App\Models\Achievement;
use App\Models\AboutGalleryImage;

class AboutController extends Controller
{
    public function index()
    {
        $teamMembers   = TeamMember::active()->ordered()->get();
        $galleryImages = AboutGalleryImage::active()->ordered()->get();
        $achievements  = Achievement::active()->ordered()->get();
        return view('website.about', compact('teamMembers', 'galleryImages', 'achievements'));
    }
}
