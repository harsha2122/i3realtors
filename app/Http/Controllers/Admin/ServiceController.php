<?php

namespace App\Http\Controllers\Admin;

use App\Domains\Services\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::ordered()->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'slug'           => 'nullable|unique:services',
            'description'    => 'required|string',
            'icon'           => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|max:3072',
            'bg_image'       => 'nullable|image|max:3072',
            'status'         => 'required|in:active,inactive',
            'order'          => 'nullable|integer',
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('services', 'public');
        }
        if ($request->hasFile('bg_image')) {
            $validated['bg_image'] = $request->file('bg_image')->store('services/bg', 'public');
        }

        Service::create($validated);
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'slug'           => 'nullable|unique:services,slug,' . $service->id,
            'description'    => 'required|string',
            'icon'           => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|max:3072',
            'bg_image'       => 'nullable|image|max:3072',
            'status'         => 'required|in:active,inactive',
            'order'          => 'nullable|integer',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($service->featured_image) Storage::disk('public')->delete($service->featured_image);
            $validated['featured_image'] = $request->file('featured_image')->store('services', 'public');
        }
        if ($request->hasFile('bg_image')) {
            if ($service->bg_image) Storage::disk('public')->delete($service->bg_image);
            $validated['bg_image'] = $request->file('bg_image')->store('services/bg', 'public');
        }

        $service->update($validated);
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->featured_image) Storage::disk('public')->delete($service->featured_image);
        if ($service->bg_image) Storage::disk('public')->delete($service->bg_image);
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }
}
