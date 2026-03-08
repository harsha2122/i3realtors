<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'       => \App\Models\User::count(),
            'total_properties'  => \App\Models\Property::count(),
            'active_properties' => \App\Models\Property::where('is_active', true)->count(),
            'recent_logins'     => \App\Models\AuditLog::where('event', 'logged_in')
                ->where('created_at', '>=', now()->subDays(7))
                ->count(),
        ];

        $recentActivity = \App\Models\AuditLog::with('user')
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentActivity'));
    }
}
