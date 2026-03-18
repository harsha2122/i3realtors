<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\DeveloperLogo;
use App\Models\Project;
use App\Models\Recognition;
use App\Domains\Services\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::active()
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        $developerLogos = DeveloperLogo::active()->get();

        $testimonials = Testimonial::active()
            ->orderByDesc('is_featured')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        $recognitions = Recognition::active()->get();

        return view('website.home', compact('projects', 'developerLogos', 'testimonials', 'recognitions'));
    }
}
