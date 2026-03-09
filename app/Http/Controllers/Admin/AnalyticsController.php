<?php

namespace App\Http\Controllers\Admin;

use App\Domains\Analytics\Services\AnalyticsService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function __construct(
        private AnalyticsService $analyticsService,
    ) {}

    public function dashboard(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $metrics = $this->analyticsService->getDashboardMetrics($dateFrom, $dateTo);
        $topPages = $this->analyticsService->getTopPages($dateFrom, $dateTo);
        $trafficSources = $this->analyticsService->getTrafficSources($dateFrom, $dateTo);
        $geographic = $this->analyticsService->getGeographicData($dateFrom, $dateTo);

        return view('admin.analytics.dashboard', compact('metrics', 'topPages', 'trafficSources', 'geographic'));
    }

    public function traffic(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $traffic = $this->analyticsService->getTrafficSources($dateFrom, $dateTo);

        return view('admin.analytics.traffic', compact('traffic'));
    }

    public function conversions(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $metrics = $this->analyticsService->getDashboardMetrics($dateFrom, $dateTo);

        return view('admin.analytics.conversions', compact('metrics'));
    }

    public function export(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $metrics = $this->analyticsService->getDashboardMetrics($dateFrom, $dateTo);
        $topPages = $this->analyticsService->getTopPages($dateFrom, $dateTo);

        $csv = "Metric,Value\n";
        $csv .= "Page Views," . $metrics['page_views'] . "\n";
        $csv .= "Unique Visitors," . $metrics['unique_visitors'] . "\n";
        $csv .= "New Leads," . $metrics['new_leads'] . "\n";
        $csv .= "Conversions," . $metrics['conversions'] . "\n";
        $csv .= "Conversion Rate," . $metrics['conversion_rate'] . "%\n\n";
        $csv .= "Top Pages\n";

        foreach ($topPages as $page) {
            $csv .= "{$page->page}," . $page->views . "\n";
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="analytics_report.csv"',
        ]);
    }
}
