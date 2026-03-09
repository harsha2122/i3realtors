<?php

namespace App\Domains\Analytics\Services;

use App\Domains\Analytics\Models\PageView;
use App\Domains\Analytics\Models\EventLog;
use App\Domains\Analytics\Models\AnalyticsSummary;
use App\Domains\Leads\Models\Lead;

class AnalyticsService
{
    public function trackPageView(string $page, ?string $referer = null): void
    {
        PageView::create([
            'page' => $page,
            'referer' => $referer ?? request()->header('referer'),
            'user_agent' => request()->userAgent(),
            'ip_address' => request()->ip(),
            'device_type' => $this->detectDeviceType(),
            'created_at' => now(),
        ]);
    }

    public function logEvent(string $eventType, ?string $entityType = null, ?int $entityId = null, ?array $changes = null): void
    {
        EventLog::create([
            'event_type' => $eventType,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'user_id' => auth()->id(),
            'changes' => $changes,
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ]);
    }

    public function getDashboardMetrics(string $dateFrom = null, string $dateTo = null)
    {
        $from = $dateFrom ? \Carbon\Carbon::parse($dateFrom) : now()->subDays(30);
        $to = $dateTo ? \Carbon\Carbon::parse($dateTo) : now();

        $pageViews = PageView::whereBetween('created_at', [$from, $to])->count();
        $uniqueVisitors = PageView::whereBetween('created_at', [$from, $to])
            ->distinct('ip_address')
            ->count('ip_address');
        $newLeads = Lead::whereBetween('created_at', [$from, $to])->count();
        $conversions = Lead::whereBetween('created_at', [$from, $to])
            ->where('status', 'converted')
            ->count();

        return [
            'page_views' => $pageViews,
            'unique_visitors' => $uniqueVisitors,
            'new_leads' => $newLeads,
            'conversions' => $conversions,
            'conversion_rate' => $newLeads > 0 ? round(($conversions / $newLeads) * 100, 2) : 0,
        ];
    }

    public function getTrafficSources(string $dateFrom = null, string $dateTo = null)
    {
        $from = $dateFrom ? \Carbon\Carbon::parse($dateFrom) : now()->subDays(30);
        $to = $dateTo ? \Carbon\Carbon::parse($dateTo) : now();

        return PageView::whereBetween('created_at', [$from, $to])
            ->whereNotNull('referer')
            ->selectRaw('referer, COUNT(*) as count')
            ->groupBy('referer')
            ->orderByDesc('count')
            ->limit(10)
            ->get();
    }

    public function getTopPages(string $dateFrom = null, string $dateTo = null)
    {
        $from = $dateFrom ? \Carbon\Carbon::parse($dateFrom) : now()->subDays(30);
        $to = $dateTo ? \Carbon\Carbon::parse($dateTo) : now();

        return PageView::whereBetween('created_at', [$from, $to])
            ->selectRaw('page, COUNT(*) as views')
            ->groupBy('page')
            ->orderByDesc('views')
            ->limit(10)
            ->get();
    }

    public function getGeographicData(string $dateFrom = null, string $dateTo = null)
    {
        $from = $dateFrom ? \Carbon\Carbon::parse($dateFrom) : now()->subDays(30);
        $to = $dateTo ? \Carbon\Carbon::parse($dateTo) : now();

        return PageView::whereBetween('created_at', [$from, $to])
            ->whereNotNull('country')
            ->selectRaw('country, COUNT(*) as count')
            ->groupBy('country')
            ->orderByDesc('count')
            ->limit(20)
            ->get();
    }

    public function generateDailySummary(string $date): void
    {
        $date = \Carbon\Carbon::parse($date);
        $pageViews = PageView::whereDate('created_at', $date)->count();
        $uniqueVisitors = PageView::whereDate('created_at', $date)
            ->distinct('ip_address')
            ->count('ip_address');

        $topPages = PageView::whereDate('created_at', $date)
            ->selectRaw('page, COUNT(*) as count')
            ->groupBy('page')
            ->orderByDesc('count')
            ->limit(5)
            ->get()
            ->pluck('count', 'page')
            ->toArray();

        $conversions = Lead::whereDate('created_at', $date)
            ->where('status', 'converted')
            ->count();
        $newLeads = Lead::whereDate('created_at', $date)->count();

        AnalyticsSummary::updateOrCreate(
            ['date' => $date],
            [
                'page_views' => $pageViews,
                'unique_visitors' => $uniqueVisitors,
                'conversion_count' => $conversions,
                'conversion_rate' => $newLeads > 0 ? ($conversions / $newLeads) * 100 : 0,
                'top_pages' => $topPages,
            ]
        );
    }

    private function detectDeviceType(): string
    {
        $userAgent = request()->userAgent();

        if (preg_match('/Mobile|Android|iPhone|iPad|iPod/', $userAgent)) {
            return 'mobile';
        } elseif (preg_match('/Tablet|iPad/', $userAgent)) {
            return 'tablet';
        }

        return 'desktop';
    }
}
