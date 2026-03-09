<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\Analytics\Services\AnalyticsService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function __construct(
        private AnalyticsService $analyticsService,
    ) {}

    public function dashboard(Request $request): JsonResponse
    {
        $metrics = $this->analyticsService->getDashboardMetrics(
            $request->input('date_from'),
            $request->input('date_to')
        );

        return response()->json($metrics);
    }

    public function traffic(Request $request): JsonResponse
    {
        $traffic = $this->analyticsService->getTrafficSources(
            $request->input('date_from'),
            $request->input('date_to')
        );

        return response()->json($traffic);
    }

    public function topPages(Request $request): JsonResponse
    {
        $pages = $this->analyticsService->getTopPages(
            $request->input('date_from'),
            $request->input('date_to')
        );

        return response()->json($pages);
    }

    public function geographic(Request $request): JsonResponse
    {
        $data = $this->analyticsService->getGeographicData(
            $request->input('date_from'),
            $request->input('date_to')
        );

        return response()->json($data);
    }
}
