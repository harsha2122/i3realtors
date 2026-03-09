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

    // Lead Routes
    Route::post('/leads/contact-form', [\App\Http\Controllers\Api\V1\LeadController::class, 'submitContactForm'])->name('leads.contact');
    Route::post('/leads/property-inquiry', [\App\Http\Controllers\Api\V1\LeadController::class, 'submitPropertyInquiry'])->name('leads.property_inquiry');
    Route::post('/forms/{form}/submit', [\App\Http\Controllers\Api\V1\LeadController::class, 'submitForm'])->name('forms.submit');
    Route::post('/newsletter/subscribe', [\App\Http\Controllers\Api\V1\LeadController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');

    // Service Routes
    Route::get('/services', [\App\Http\Controllers\Api\V1\ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{service}', [\App\Http\Controllers\Api\V1\ServiceController::class, 'show'])->name('services.show');
    Route::get('/services/category/{category}', [\App\Http\Controllers\Api\V1\ServiceController::class, 'byCategory'])->name('services.byCategory');
    Route::get('/services/slug/{slug}', [\App\Http\Controllers\Api\V1\ServiceController::class, 'bySlug'])->name('services.bySlug');

    // Team Routes
    Route::get('/team-members', [\App\Http\Controllers\Api\V1\TeamMemberController::class, 'index'])->name('team.index');
    Route::get('/team-members/{member}', [\App\Http\Controllers\Api\V1\TeamMemberController::class, 'show'])->name('team.show');
    Route::get('/team-members/department/{department}', [\App\Http\Controllers\Api\V1\TeamMemberController::class, 'byDepartment'])->name('team.byDepartment');

    // Testimonial Routes
    Route::get('/testimonials', [\App\Http\Controllers\Api\V1\TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/featured', [\App\Http\Controllers\Api\V1\TestimonialController::class, 'featured'])->name('testimonials.featured');
    Route::get('/testimonials/rating/{rating}', [\App\Http\Controllers\Api\V1\TestimonialController::class, 'byRating'])->name('testimonials.byRating');

});
