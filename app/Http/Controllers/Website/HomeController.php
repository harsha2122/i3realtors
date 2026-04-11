<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\DeveloperLogo;
use App\Models\Project;
use App\Models\Recognition;
use App\Models\Setting;
use App\Domains\Services\Models\Service;
use App\Domains\Services\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::active()
            ->where('is_featured', true)
            ->where('status', 'ongoing')
            ->whereNotNull('thumbnail')
            ->where('thumbnail', '!=', '')
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        // Fallback: if no featured+ongoing projects, show any featured with image
        if ($projects->isEmpty()) {
            $projects = Project::active()
                ->where('is_featured', true)
                ->whereNotNull('thumbnail')
                ->where('thumbnail', '!=', '')
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->limit(4)
                ->get();
        }

        // Final fallback: latest active projects with images
        if ($projects->isEmpty()) {
            $projects = Project::active()
                ->whereNotNull('thumbnail')
                ->where('thumbnail', '!=', '')
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->limit(4)
                ->get();
        }

        // Strip out any projects whose uploaded file no longer exists on disk
        $projects = $projects->filter(function ($p) {
            return $p->thumbnail && Storage::disk('public')->exists($p->thumbnail);
        })->values()->take(4);

        $developerLogos = DeveloperLogo::active()->get();

        $testimonials = Testimonial::active()
            ->orderByDesc('is_featured')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        $recognitions = Recognition::active()->get();

        $services = Service::active()->ordered()->get();

        $heroSettings = [
            'fluid_animation' => (bool) Setting::get('hero_fluid_animation', true),
            'video_type'      => Setting::get('hero_video_type', 'none'),
            'video_url'       => Setting::get('hero_video_url', ''),
            'video_start'     => (int) Setting::get('hero_video_start', 0),
            'video_end'       => (int) Setting::get('hero_video_end', 0),
            'video_file'      => Setting::get('hero_video_file', ''),
        ];

        return view('website.home', compact('projects', 'developerLogos', 'testimonials', 'recognitions', 'heroSettings', 'services'));
    }
}
