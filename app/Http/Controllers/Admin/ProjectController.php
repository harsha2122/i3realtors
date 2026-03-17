<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(private ProjectService $service) {}

    public function index(Request $request)
    {
        $filters  = $request->only(['search', 'type', 'status', 'city', 'is_active']);
        $projects = $this->service->adminList($filters, 15);
        return view('admin.projects.index', compact('projects', 'filters'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'status'            => 'required|in:upcoming,ongoing,completed',
            'type'              => 'required|in:residential,commercial,industrial,infrastructure,mixed_use',
            'area'              => 'nullable|numeric|min:0',
            'area_unit'         => 'nullable|string|max:20',
            'units'             => 'nullable|integer|min:0',
            'floors'            => 'nullable|integer|min:0|max:200',
            'completion_year'   => 'nullable|integer|min:1900|max:2100',
            'location'          => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:100',
            'state'             => 'nullable|string|max:100',
            'google_maps_url'   => 'nullable|url',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
            'is_featured'       => 'nullable|boolean',
            'is_active'         => 'nullable|boolean',
            'sort_order'        => 'nullable|integer|min:0',
            'thumbnail'         => 'nullable|image|max:4096',
            'gallery.*'         => 'nullable|image|max:4096',
        ]);

        $this->service->create(
            $data,
            $request->file('thumbnail'),
            $request->file('gallery') ?? []
        );

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(int $id)
    {
        $project = $this->service->find($id);
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'status'            => 'required|in:upcoming,ongoing,completed',
            'type'              => 'required|in:residential,commercial,industrial,infrastructure,mixed_use',
            'area'              => 'nullable|numeric|min:0',
            'area_unit'         => 'nullable|string|max:20',
            'units'             => 'nullable|integer|min:0',
            'floors'            => 'nullable|integer|min:0|max:200',
            'completion_year'   => 'nullable|integer|min:1900|max:2100',
            'location'          => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:100',
            'state'             => 'nullable|string|max:100',
            'google_maps_url'   => 'nullable|url',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
            'is_featured'       => 'nullable|boolean',
            'is_active'         => 'nullable|boolean',
            'sort_order'        => 'nullable|integer|min:0',
            'thumbnail'         => 'nullable|image|max:4096',
            'gallery.*'         => 'nullable|image|max:4096',
        ]);

        $this->service->update(
            $id,
            $data,
            $request->file('thumbnail'),
            $request->file('gallery') ?? []
        );

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function destroyImage(int $imageId)
    {
        $this->service->deleteImage($imageId);
        return response()->json(['success' => true]);
    }
}
