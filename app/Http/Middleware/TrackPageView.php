<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Domains\Analytics\Services\AnalyticsService;

class TrackPageView
{
    public function __construct(
        private AnalyticsService $analyticsService,
    ) {}

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->isMethod('get') && $response->status() === 200) {
            try {
                $this->analyticsService->trackPageView($request->path());
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning('Page view tracking failed: ' . $e->getMessage());
            }
        }

        return $response;
    }
}
