<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\Services\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $services = Service::active()->ordered()->get();
        return response()->json($services);
    }

    public function show(Service $service): JsonResponse
    {
        return response()->json($service->load('images'));
    }

    public function byCategory(string $category): JsonResponse
    {
        $services = Service::active()->byCategory($category)->ordered()->get();
        return response()->json($services);
    }

    public function bySlug(string $slug): JsonResponse
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        return response()->json($service->load('images'));
    }
}
