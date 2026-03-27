<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamGalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamGalleryController extends Controller
{
    public function index()
    {
        $images = TeamGalleryImage::ordered()->get();
        return view('admin.team.gallery', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images'   => 'required|array|min:1',
            'images.*' => 'required|image|max:4096',
        ]);

        $sortStart = TeamGalleryImage::max('sort_order') + 1;

        foreach ($request->file('images') as $i => $file) {
            $path = $file->store('team-gallery', 'public');
            TeamGalleryImage::create([
                'image_path' => $path,
                'sort_order' => $sortStart + $i,
            ]);
        }

        return back()->with('success', 'Images uploaded successfully.');
    }

    public function destroy(TeamGalleryImage $teamGallery)
    {
        if ($teamGallery->image_path && Storage::disk('public')->exists($teamGallery->image_path)) {
            Storage::disk('public')->delete($teamGallery->image_path);
        }
        $teamGallery->delete();

        return back()->with('success', 'Image deleted.');
    }

    public function toggle(TeamGalleryImage $teamGallery)
    {
        $teamGallery->update(['is_active' => !$teamGallery->is_active]);
        return back()->with('success', 'Image visibility updated.');
    }
}
