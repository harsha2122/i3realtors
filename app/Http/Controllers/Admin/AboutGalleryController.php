<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutGalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutGalleryController extends Controller
{
    public function index()
    {
        $images = AboutGalleryImage::ordered()->get();
        return view('admin.about-gallery.index', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images'   => 'required|array|min:1',
            'images.*' => 'required|image|max:5120',
        ]);

        $sortStart = AboutGalleryImage::max('sort_order') + 1;

        foreach ($request->file('images') as $i => $file) {
            $path = $file->store('about-gallery', 'public');
            AboutGalleryImage::create([
                'image_path' => $path,
                'sort_order' => $sortStart + $i,
                'is_active'  => true,
            ]);
        }

        return back()->with('success', count($request->file('images')) . ' image(s) uploaded successfully.');
    }

    public function destroy(AboutGalleryImage $aboutGallery)
    {
        if ($aboutGallery->image_path && Storage::disk('public')->exists($aboutGallery->image_path)) {
            Storage::disk('public')->delete($aboutGallery->image_path);
        }
        $aboutGallery->delete();
        return back()->with('success', 'Image deleted.');
    }

    public function toggle(AboutGalleryImage $aboutGallery)
    {
        $aboutGallery->update(['is_active' => !$aboutGallery->is_active]);
        return back()->with('success', 'Visibility updated.');
    }
}
