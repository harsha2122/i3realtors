<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $filters  = $request->only(['search', 'category', 'is_active']);
        $query    = GalleryImage::query();

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('caption', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('category', 'like', '%' . $filters['search'] . '%');
            });
        }
        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }
        if (isset($filters['is_active']) && $filters['is_active'] !== '') {
            $query->where('is_active', $filters['is_active']);
        }

        $images     = $query->orderBy('sort_order')->orderByDesc('created_at')->paginate(20);
        $categories = GalleryImage::whereNotNull('category')->distinct()->orderBy('category')->pluck('category');

        return view('admin.gallery.index', compact('images', 'filters', 'categories'));
    }

    public function create()
    {
        $categories = GalleryImage::whereNotNull('category')->distinct()->orderBy('category')->pluck('category');
        return view('admin.gallery.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'nullable|string|max:255',
            'caption'    => 'nullable|string|max:500',
            'category'   => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'nullable|boolean',
            'images'     => 'required|array|min:1',
            'images.*'   => 'required|image|max:5120',
        ]);

        $sortOrder = (int) ($data['sort_order'] ?? 0);

        foreach ($request->file('images') as $file) {
            $path = $file->store('gallery', ['disk' => 'uploads']);

            GalleryImage::create([
                'title'      => $data['title'] ?? null,
                'caption'    => $data['caption'] ?? null,
                'category'   => $data['category'] ?? null,
                'sort_order' => $sortOrder,
                'is_active'  => $request->boolean('is_active', true),
                'image'      => $path,
            ]);

            $sortOrder++;
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery images uploaded successfully.');
    }

    public function edit(GalleryImage $gallery)
    {
        $categories = GalleryImage::whereNotNull('category')->distinct()->orderBy('category')->pluck('category');
        return view('admin.gallery.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, GalleryImage $gallery)
    {
        $data = $request->validate([
            'title'      => 'nullable|string|max:255',
            'caption'    => 'nullable|string|max:500',
            'category'   => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'nullable|boolean',
            'image'      => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            $oldPath = public_path('uploads/' . $gallery->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
            $data['image'] = $request->file('image')->store('gallery', ['disk' => 'uploads']);
        }

        $data['is_active'] = $request->boolean('is_active', true);

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(GalleryImage $gallery)
    {
        $oldPath = public_path('uploads/' . $gallery->image);
        if (file_exists($oldPath)) {
            @unlink($oldPath);
        }
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Image deleted successfully.');
    }
}
