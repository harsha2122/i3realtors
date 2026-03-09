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

        // Properties
        Route::delete('/properties/images/{imageId}', [Admin\PropertyController::class, 'destroyImage'])->name('properties.image.destroy');
        Route::resource('properties', Admin\PropertyController::class);

        // Settings
        Route::get('/settings', [Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [Admin\SettingController::class, 'update'])->name('settings.update');
        Route::get('/settings/{group}', [Admin\SettingController::class, 'group'])->name('settings.group');

        // Media management (delete logo, favicon, etc.)
        Route::delete('/media', [Admin\MediaController::class, 'destroy'])->name('media.destroy');

        // Blog Management
        Route::resource('blog', Admin\BlogController::class);
        Route::post('/blog/{post}/publish', [Admin\BlogController::class, 'publish'])->name('blog.publish');
        Route::post('/blog/{post}/archive', [Admin\BlogController::class, 'archive'])->name('blog.archive');
        Route::post('/blog/bulk-action', [Admin\BlogController::class, 'bulkAction'])->name('blog.bulkAction');

        // Category Management
        Route::resource('categories', Admin\CategoryController::class);

        // Comment Moderation
        Route::get('/comments', [Admin\CommentController::class, 'index'])->name('comments.index');
        Route::get('/comments/spam', [Admin\CommentController::class, 'spam'])->name('comments.spam');
        Route::post('/comments/{comment}/approve', [Admin\CommentController::class, 'approve'])->name('comments.approve');
        Route::post('/comments/{comment}/reject', [Admin\CommentController::class, 'reject'])->name('comments.reject');
        Route::post('/comments/{comment}/spam', [Admin\CommentController::class, 'markSpam'])->name('comments.spam');
        Route::delete('/comments/{comment}', [Admin\CommentController::class, 'destroy'])->name('comments.destroy');
        Route::post('/comments/bulk-action', [Admin\CommentController::class, 'bulkAction'])->name('comments.bulkAction');
    });
});
