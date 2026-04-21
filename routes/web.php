<?php

use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\PesananController;
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

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('paket', PaketController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('pesanan', PesananController::class);
    Route::resource('company-profile', CompanyProfileController::class)->only([
        'show', 'edit', 'update'
    ]);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
});

/*
|--------------------------------------------------------------------------
| Chatbot API Routes (Customer Service with RAG)
|--------------------------------------------------------------------------
*/
Route::prefix('api/chatbot')->name('chatbot.')->group(function () {
    Route::get('/menu', [ChatbotController::class, 'getMenu'])->name('menu');
    Route::post('/message', [ChatbotController::class, 'handleMessage'])->name('message');
    Route::post('/search-pesanan', [ChatbotController::class, 'searchPesanan'])->name('search.pesanan');
    Route::get('/pakets', [ChatbotController::class, 'getPakets'])->name('pakets');
    Route::get('/company-profile', [ChatbotController::class, 'getCompanyProfile'])->name('company');
});