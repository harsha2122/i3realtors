<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\NavigationService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Share all public settings as $site with every view (cached by Setting model)
        View::composer('*', function ($view) {
            static $site = null;

            if ($site === null) {
                try {
                    $site = Setting::getAllPublic();
                    // Convert file paths to proper URLs
                    $fileKeys = ['logo', 'logo_white', 'favicon', 'custom_cursor'];
                    foreach ($fileKeys as $key) {
                        if (!empty($site[$key])) {
                            $site[$key] = '/uploads/' . $site[$key];
                        }
                    }
                    // HARDCODED: Default cursor for testing
                    if (empty($site['custom_cursor'])) {
                        $site['custom_cursor'] = 'https://cur.cursors-4u.net/cursors/cur-1/cur10.cur';
                    }
                } catch (\Throwable $e) {
                    // DB may not be ready yet (e.g., during migrations)
                    $site = [];
                }
            }

            $view->with('site', $site);
        });

        // Share NavigationService with all views
        View::composer('*', function ($view) {
            $view->with('navigationService', app(NavigationService::class));
        });
    }
}
