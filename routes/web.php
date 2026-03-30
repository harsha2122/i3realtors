<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Website;

/*
|--------------------------------------------------------------------------
| Public Website Routes
|--------------------------------------------------------------------------
*/

// File serving route (must be before catch-all routes)
Route::get('/uploads/{path}', function ($path) {
    $file = public_path('uploads/' . $path);
    if (!file_exists($file)) {
        abort(404);
    }
    return response()->file($file);
})->where('path', '.*');

Route::get('/', [Website\HomeController::class, 'index'])->name('home');
Route::get('/about', [Website\AboutController::class, 'index'])->name('about');
Route::get('/services', [Website\ServiceController::class, 'index'])->name('services');
Route::get('/services/fund-raising', [Website\FundRaisingController::class, 'index'])->name('services.fund-raising');
Route::get('/calculator', [Website\CalculatorController::class, 'index'])->name('calculator');
Route::get('/team', [Website\TeamController::class, 'index'])->name('team');
Route::get('/contact', [Website\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [Website\ContactController::class, 'submit'])->name('contact.submit');
Route::get('/careers', [Website\CareersController::class, 'index'])->name('careers');
Route::post('/careers', [Website\CareersController::class, 'submit'])->name('careers.submit');
// Projects (Ongoing & Completed) - main public section
Route::get('/projects', [Website\ProjectController::class, 'index'])->name('website.projects.index');
Route::get('/projects/{slug}', [Website\ProjectController::class, 'show'])->name('website.projects.show');

// Properties - accessible via CTA, kept for admin management
Route::get('/properties', [Website\PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{slug}', [Website\PropertyController::class, 'show'])->name('properties.show');
Route::get('/blog', [Website\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [Website\BlogController::class, 'show'])->name('blog.show');

// Gallery
Route::get('/gallery', [Website\GalleryController::class, 'index'])->name('gallery.index');

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

        // Projects
        Route::delete('/projects/images/{imageId}', [Admin\ProjectController::class, 'destroyImage'])->name('projects.image.destroy');
        Route::resource('projects', Admin\ProjectController::class);

        // Settings
        Route::get('/settings', [Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [Admin\SettingController::class, 'update'])->name('settings.update');
        Route::get('/settings/{group}', [Admin\SettingController::class, 'group'])->name('settings.group');

        // Media management (delete logo, favicon, etc.)
        Route::delete('/media', [Admin\MediaController::class, 'destroy'])->name('media.destroy');

        // Blog Management
        Route::resource('blog', Admin\BlogController::class)->parameters(['blog' => 'post']);
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
        Route::post('/comments/{comment}/spam', [Admin\CommentController::class, 'markSpam'])->name('comments.markSpam');
        Route::delete('/comments/{comment}', [Admin\CommentController::class, 'destroy'])->name('comments.destroy');
        Route::post('/comments/bulk-action', [Admin\CommentController::class, 'bulkAction'])->name('comments.bulkAction');

        // Lead Management
        Route::get('/leads', [Admin\LeadController::class, 'index'])->name('leads.index');
        Route::post('/leads', [Admin\LeadController::class, 'store'])->name('leads.store');
        Route::get('/leads/{lead}', [Admin\LeadController::class, 'show'])->name('leads.show');
        Route::put('/leads/{lead}', [Admin\LeadController::class, 'update'])->name('leads.update');
        Route::delete('/leads/{lead}', [Admin\LeadController::class, 'destroy'])->name('leads.destroy');
        Route::post('/leads/{lead}/note', [Admin\LeadController::class, 'addNote'])->name('leads.note');
        Route::post('/leads/{lead}/status', [Admin\LeadController::class, 'updateStatus'])->name('leads.status');
        Route::post('/leads/{lead}/assign', [Admin\LeadController::class, 'assign'])->name('leads.assign');
        Route::post('/leads/bulk-action', [Admin\LeadController::class, 'bulkAction'])->name('leads.bulkAction');
        Route::get('/leads/export', [Admin\LeadController::class, 'export'])->name('leads.export');

        // Form Builder
        Route::get('/forms', [Admin\FormController::class, 'index'])->name('forms.index');
        Route::get('/forms/create', [Admin\FormController::class, 'create'])->name('forms.create');
        Route::post('/forms', [Admin\FormController::class, 'store'])->name('forms.store');
        Route::get('/forms/{form}/edit', [Admin\FormController::class, 'edit'])->name('forms.edit');
        Route::put('/forms/{form}', [Admin\FormController::class, 'update'])->name('forms.update');
        Route::delete('/forms/{form}', [Admin\FormController::class, 'destroy'])->name('forms.destroy');
        Route::post('/forms/{form}/fields', [Admin\FormController::class, 'addField'])->name('forms.addField');
        Route::put('/form-fields/{field}', [Admin\FormController::class, 'updateField'])->name('forms.updateField');
        Route::delete('/form-fields/{field}', [Admin\FormController::class, 'deleteField'])->name('forms.deleteField');
        Route::post('/forms/{form}/reorder', [Admin\FormController::class, 'reorder'])->name('forms.reorder');
        Route::get('/forms/{form}/submissions', [Admin\FormController::class, 'submissions'])->name('forms.submissions');
        Route::get('/forms/{form}/submissions/export', [Admin\FormController::class, 'exportSubmissions'])->name('forms.exportSubmissions');

        // Contact & Career Form Submissions
        Route::get('/contact-submissions', [Admin\FormController::class, 'contactSubmissions'])->name('contact-submissions.index');
        Route::get('/contact-submissions/export', [Admin\FormController::class, 'exportContactSubmissions'])->name('contact-submissions.export');
        Route::get('/career-submissions', [Admin\FormController::class, 'careerSubmissions'])->name('career-submissions.index');
        Route::get('/career-submissions/export', [Admin\FormController::class, 'exportCareerSubmissions'])->name('career-submissions.export');

        // Service Management
        Route::resource('services', Admin\ServiceController::class);

        // Team Management
        Route::resource('team', Admin\TeamMemberController::class);
        Route::get('/team-gallery', [Admin\TeamGalleryController::class, 'index'])->name('team-gallery.index');
        Route::post('/team-gallery', [Admin\TeamGalleryController::class, 'store'])->name('team-gallery.store');
        Route::delete('/team-gallery/{teamGallery}', [Admin\TeamGalleryController::class, 'destroy'])->name('team-gallery.destroy');
        Route::patch('/team-gallery/{teamGallery}/toggle', [Admin\TeamGalleryController::class, 'toggle'])->name('team-gallery.toggle');

        // Developer Logos
        Route::resource('developer-logos', Admin\DeveloperLogoController::class);

        // Recognitions
        Route::resource('recognitions', Admin\RecognitionController::class);

        // Achievements
        Route::resource('achievements', Admin\AchievementController::class);

        // Fund Raising Logos
        Route::resource('fund-raising-logos', Admin\FundRaisingLogoController::class);

        // Testimonial Management
        Route::resource('testimonials', Admin\TestimonialController::class);

        // Navigation Management
        Route::resource('navigation', Admin\NavigationController::class);
        Route::post('/navigation/{menu}/items', [Admin\NavigationController::class, 'addItem'])->name('navigation.addItem');
        Route::put('/navigation-items/{item}', [Admin\NavigationController::class, 'updateItem'])->name('navigation.updateItem');
        Route::delete('/navigation-items/{item}', [Admin\NavigationController::class, 'deleteItem'])->name('navigation.deleteItem');
        Route::post('/navigation/{menu}/reorder', [Admin\NavigationController::class, 'reorder'])->name('navigation.reorder');
        Route::get('/navigation/{menu}/preview', [Admin\NavigationController::class, 'preview'])->name('navigation.preview');
        Route::post('/navigation/{menu}/duplicate', [Admin\NavigationController::class, 'duplicate'])->name('navigation.duplicate');
        Route::get('/navigation/{menu}/export', [Admin\NavigationController::class, 'export'])->name('navigation.export');
        Route::post('/navigation/import', [Admin\NavigationController::class, 'import'])->name('navigation.import');

        // Gallery
        Route::resource('gallery', Admin\GalleryController::class);

        // Analytics
        Route::get('/analytics/dashboard', [Admin\AnalyticsController::class, 'dashboard'])->name('analytics.dashboard');
        Route::get('/analytics/traffic', [Admin\AnalyticsController::class, 'traffic'])->name('analytics.traffic');
        Route::get('/analytics/conversions', [Admin\AnalyticsController::class, 'conversions'])->name('analytics.conversions');
        Route::get('/analytics/export', [Admin\AnalyticsController::class, 'export'])->name('analytics.export');
    });
});
