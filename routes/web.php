<?php

use App\Http\Controllers\Admin\PaketController;
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