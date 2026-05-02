<?php

use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Chatbot\ChatbotController;
use App\Http\Controllers\Customer\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Customer Routes (Customer Side)
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/packages', [PageController::class, 'packages'])->name('packages');
Route::get('/packages/search', [PageController::class, 'search'])->name('packages.search');
Route::get('/package/{id}', [PageController::class, 'packageDetail'])->name('package.detail');
Route::get('/photos', [PageController::class, 'photos'])->name('photos');

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('paket', PaketController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('pesanan', PesananController::class);
    Route::resource('company-profile', CompanyProfileController::class)->only([
        'show',
        'edit',
        'update'
    ]);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // AJAX endpoint for gallery dependent dropdown
    Route::get('/api/gallery/relations', [GalleryController::class, 'getRelationsByPaket'])->name('gallery.relations');
});

/*
|--------------------------------------------------------------------------
| Chatbot API Routes (Admin-only, rule-based)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('api/chatbot')->name('chatbot.')->group(function () {
    Route::get('/menu', [ChatbotController::class, 'getMenu'])->name('menu');
    Route::post('/message', [ChatbotController::class, 'handleMessage'])->name('message');
});
