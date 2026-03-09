<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\Services\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TestimonialController extends Controller
{
    public function index(): JsonResponse
    {
        $testimonials = Testimonial::active()->latest()->get();
        return response()->json($testimonials);
    }

    public function featured(): JsonResponse
    {
        $testimonials = Testimonial::featured()->get();
        return response()->json($testimonials);
    }

    public function byRating(int $rating): JsonResponse
    {
        $testimonials = Testimonial::active()->byRating($rating)->get();
        return response()->json($testimonials);
    }
}
