<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\PropertyService;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function __construct(private PropertyService $service) {}

    public function index(Request $request)
    {
        $filters    = $request->only(['search', 'type', 'status', 'city']);
        $properties = $this->service->publicList($filters, 9);
        $cities     = $this->service->cities();

        return view('website.properties', compact('properties', 'filters', 'cities'));
    }

    public function show(string $slug)
    {
        $property = $this->service->findBySlug($slug);

        abort_if(!$property || !$property->is_active, 404);

        $related = $this->service->publicList(['type' => $property->type], 3);

        return view('website.property-details', compact('property', 'related'));
    }
}
