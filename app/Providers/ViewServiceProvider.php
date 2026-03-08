<?php

namespace App\Providers;

use App\Models\Setting;
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
                } catch (\Throwable $e) {
                    // DB may not be ready yet (e.g., during migrations)
                    $site = [];
                }
            }

            $view->with('site', $site);
        });
    }
}
