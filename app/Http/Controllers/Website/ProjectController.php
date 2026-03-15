<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(private ProjectService $service) {}

    public function index(Request $request)
    {
        $filters  = $request->only(['search', 'type', 'status', 'city']);
        $projects = $this->service->publicList($filters, 9);
        $cities   = $this->service->cities();

        return view('website.projects', compact('projects', 'filters', 'cities'));
    }

    public function show(string $slug)
    {
        $project = $this->service->findBySlug($slug);

        abort_if(!$project || !$project->is_active, 404);

        $related = $this->service->publicList(['type' => $project->type], 3);

        return view('website.project-details', compact('project', 'related'));
    }
}
