<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes v1
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->name('api.v1.')->group(function () {

    // Public Settings
    Route::get('/settings', function () {
        return response()->json([
            'success' => true,
            'data'    => \App\Models\Setting::getAllPublic(),
        ]);
    })->name('settings.public');

    // Health Check
    Route::get('/health', function () {
        return response()->json([
            'success' => true,
            'status'  => 'healthy',
            'version' => '1.0.0',
        ]);
    })->name('health');

});
