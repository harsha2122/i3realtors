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

    // Blog Routes
    Route::get('/posts', [\App\Http\Controllers\Api\V1\BlogController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}', [\App\Http\Controllers\Api\V1\BlogController::class, 'show'])->name('posts.show');
    Route::get('/posts/slug/{slug}', [\App\Http\Controllers\Api\V1\BlogController::class, 'bySlug'])->name('posts.bySlug');
    Route::get('/posts/featured/{limit?}', [\App\Http\Controllers\Api\V1\BlogController::class, 'featured'])->name('posts.featured');
    Route::get('/posts/category/{categoryId}', [\App\Http\Controllers\Api\V1\BlogController::class, 'byCategory'])->name('posts.byCategory');
    Route::get('/posts/tag/{tagId}', [\App\Http\Controllers\Api\V1\BlogController::class, 'byTag'])->name('posts.byTag');
    Route::get('/posts/{post}/related/{limit?}', [\App\Http\Controllers\Api\V1\BlogController::class, 'related'])->name('posts.related');
    Route::get('/posts/search/{query}', [\App\Http\Controllers\Api\V1\BlogController::class, 'search'])->name('posts.search');

    // Category Routes
    Route::get('/categories', [\App\Http\Controllers\Api\V1\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [\App\Http\Controllers\Api\V1\CategoryController::class, 'show'])->name('categories.show');

    // Comments Routes
    Route::get('/posts/{post}/comments', [\App\Http\Controllers\Api\V1\CommentController::class, 'index'])->name('comments.index');
    Route::post('/posts/{post}/comments', [\App\Http\Controllers\Api\V1\CommentController::class, 'store'])->name('comments.store');

});
