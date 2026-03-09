<?php

namespace App\Http\Controllers\Admin;

use App\Domains\Services\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(15);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'slug' => 'nullable|unique:services',
            'description' => 'required',
            'icon' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'category' => 'nullable|string',
        ]);

        if (!$validated['slug'] ?? false) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('services', 'public');
        }

        Service::create($validated);
        return redirect()->route('admin.services.index')->with('success', 'Service created');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'slug' => 'nullable|unique:services,slug,' . $service->id,
            'description' => 'required',
            'icon' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'category' => 'nullable|string',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('services', 'public');
        }

        $service->update($validated);
        return redirect()->back()->with('success', 'Service updated');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->back()->with('success', 'Service deleted');
    }
}
