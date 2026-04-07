<?php

use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes (Customer Side)
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/packages', [FrontendController::class, 'packages'])->name('packages');
Route::get('/packages/search', [FrontendController::class, 'search'])->name('packages.search');
Route::get('/package/{id}', [FrontendController::class, 'packageDetail'])->name('package.detail');
Route::get('/photos', [FrontendController::class, 'photos'])->name('photos');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::resource('paket', PaketController::class)->names([
        'index' => 'admin.paket.index',
        'create' => 'admin.paket.create',
        'store' => 'admin.paket.store',
        'show' => 'admin.paket.show',
        'edit' => 'admin.paket.edit',
        'update' => 'admin.paket.update',
        'destroy' => 'admin.paket.destroy',
    ]);
});