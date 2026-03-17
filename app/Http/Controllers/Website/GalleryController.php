<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $activeCategory = $request->get('category', '');

        $query = GalleryImage::active();

        if ($activeCategory) {
            $query->where('category', $activeCategory);
        }

        $images     = $query->orderBy('sort_order')->orderByDesc('created_at')->paginate(18);
        $categories = GalleryImage::active()->whereNotNull('category')->distinct()->orderBy('category')->pluck('category');

        return view('website.gallery', compact('images', 'categories', 'activeCategory'));
    }
}
