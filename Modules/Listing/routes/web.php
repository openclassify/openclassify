<?php
use Illuminate\Support\Facades\Route;
use Modules\Listing\Http\Controllers\ListingController;

Route::prefix('listings')->name('listings.')->group(function () {
    Route::get('/', [ListingController::class, 'index'])->name('index');
    Route::get('/create', [ListingController::class, 'create'])->name('create')->middleware('auth');
    Route::post('/', [ListingController::class, 'store'])->name('store')->middleware('auth');
    Route::get('/{listing}', [ListingController::class, 'show'])->name('show');
});
