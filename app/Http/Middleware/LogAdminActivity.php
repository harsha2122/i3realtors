<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Domains\Analytics\Services\AnalyticsService;

class LogAdminActivity
{
    public function __construct(
        private AnalyticsService $analyticsService,
    ) {}

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('delete')) {
            $this->analyticsService->logEvent(
                event_type: $request->getMethod(),
                entity_type: $this->getEntityType($request),
                changes: $request->all()
            );
        }

        return $response;
    }

    private function getEntityType(Request $request): ?string
    {
        $path = $request->path();
        $segments = explode('/', $path);

        return $segments[1] ?? null;
    }
}
