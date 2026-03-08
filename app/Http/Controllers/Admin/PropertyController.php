<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PropertyService;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function __construct(private PropertyService $service) {}

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'type', 'status', 'city', 'is_active']);
        $properties = $this->service->adminList($filters, 15);
        return view('admin.properties.index', compact('properties', 'filters'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'price'             => 'nullable|numeric|min:0',
            'price_label'       => 'nullable|string|max:100',
            'price_type'        => 'required|in:sale,rent,lease',
            'type'              => 'required|in:residential,commercial,industrial,infrastructure,plot',
            'status'            => 'required|in:available,sold,under_construction,coming_soon',
            'area'              => 'nullable|numeric|min:0',
            'area_unit'         => 'nullable|string|max:20',
            'bedrooms'          => 'nullable|integer|min:0|max:50',
            'bathrooms'         => 'nullable|integer|min:0|max:50',
            'floors'            => 'nullable|integer|min:0|max:200',
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

        return redirect()->route('admin.properties.index')
            ->with('success', 'Property created successfully.');
    }

    public function edit(int $id)
    {
        $property = $this->service->find($id);
        return view('admin.properties.edit', compact('property'));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'price'             => 'nullable|numeric|min:0',
            'price_label'       => 'nullable|string|max:100',
            'price_type'        => 'required|in:sale,rent,lease',
            'type'              => 'required|in:residential,commercial,industrial,infrastructure,plot',
            'status'            => 'required|in:available,sold,under_construction,coming_soon',
            'area'              => 'nullable|numeric|min:0',
            'area_unit'         => 'nullable|string|max:20',
            'bedrooms'          => 'nullable|integer|min:0|max:50',
            'bathrooms'         => 'nullable|integer|min:0|max:50',
            'floors'            => 'nullable|integer|min:0|max:200',
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

        return redirect()->route('admin.properties.index')
            ->with('success', 'Property updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('admin.properties.index')
            ->with('success', 'Property deleted successfully.');
    }

    public function destroyImage(int $imageId)
    {
        $this->service->deleteImage($imageId);
        return response()->json(['success' => true]);
    }
}
