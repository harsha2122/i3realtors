<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Website;

/*
|--------------------------------------------------------------------------
| Public Website Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [Website\HomeController::class, 'index'])->name('home');
Route::get('/about', [Website\AboutController::class, 'index'])->name('about');
Route::get('/services', [Website\ServiceController::class, 'index'])->name('services');
Route::get('/team', [Website\TeamController::class, 'index'])->name('team');
Route::get('/contact', [Website\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [Website\ContactController::class, 'submit'])->name('contact.submit');
Route::get('/projects', [Website\PropertyController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [Website\PropertyController::class, 'show'])->name('projects.show');
Route::get('/blog', [Website\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [Website\BlogController::class, 'show'])->name('blog.show');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Auth (Guest Only)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [Admin\AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [Admin\AuthController::class, 'login'])->name('login.submit');
    });

    Route::post('/logout', [Admin\AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

        // User Management
        Route::resource('users', Admin\UserController::class);

        // Settings
        Route::get('/settings', [Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [Admin\SettingController::class, 'update'])->name('settings.update');
        Route::get('/settings/{group}', [Admin\SettingController::class, 'group'])->name('settings.group');

        // Media management (delete logo, favicon, etc.)
        Route::delete('/media', [Admin\MediaController::class, 'destroy'])->name('media.destroy');
    });
});
