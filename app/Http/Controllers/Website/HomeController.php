<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\DeveloperLogo;
use App\Models\Project;
use App\Models\Recognition;
use App\Models\Setting;
use App\Domains\Services\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::active()->where('is_featured', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        // Fallback: if no featured projects, show latest active ones
        if ($projects->isEmpty()) {
            $projects = Project::active()
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->limit(4)
                ->get();
        }

        $developerLogos = DeveloperLogo::active()->get();

        $testimonials = Testimonial::active()
            ->orderByDesc('is_featured')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        $recognitions = Recognition::active()->get();

        $heroSettings = [
            'fluid_animation' => (bool) Setting::get('hero_fluid_animation', true),
            'video_type'      => Setting::get('hero_video_type', 'none'),
            'video_url'       => Setting::get('hero_video_url', ''),
            'video_start'     => (int) Setting::get('hero_video_start', 0),
            'video_end'       => (int) Setting::get('hero_video_end', 0),
            'video_file'      => Setting::get('hero_video_file', ''),
        ];

        return view('website.home', compact('projects', 'developerLogos', 'testimonials', 'recognitions', 'heroSettings'));
    }
}
