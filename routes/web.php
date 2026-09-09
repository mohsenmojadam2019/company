<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/services', [SiteController::class, 'services'])->name('services.index');
Route::get('/services/{service}', [SiteController::class, 'service'])->name('services.show');
Route::get('/projects', [SiteController::class, 'projects'])->name('projects.index');
Route::get('/projects/{project}', [SiteController::class, 'project'])->name('projects.show');
Route::get('/insights', [SiteController::class, 'blog'])->name('blog.index');
Route::get('/insights/{post}', [SiteController::class, 'post'])->name('blog.show');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('/login', [AuthController::class, 'create'])->name('login');
        Route::post('/login', [AuthController::class, 'store'])->middleware('throttle:5,1')->name('login.store');
    });

    Route::middleware(['auth', 'admin'])->group(function (): void {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
        Route::get('/content/{resource}', [CmsController::class, 'index'])->name('cms.index');
        Route::get('/content/{resource}/create', [CmsController::class, 'create'])->name('cms.create');
        Route::post('/content/{resource}', [CmsController::class, 'store'])->name('cms.store');
        Route::get('/content/{resource}/{id}/edit', [CmsController::class, 'edit'])->name('cms.edit');
        Route::put('/content/{resource}/{id}', [CmsController::class, 'update'])->name('cms.update');
        Route::delete('/content/{resource}/{id}', [CmsController::class, 'destroy'])->name('cms.destroy');
        Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
        Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    });
});
