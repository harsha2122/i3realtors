<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\Blogs\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::where('is_active', true)->get();

        return response()->json($categories);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json($category->load('posts'));
    }
}
