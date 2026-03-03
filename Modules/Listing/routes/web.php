<?php
use Illuminate\Support\Facades\Route;
use Modules\Listing\Http\Controllers\ListingController;

Route::middleware('web')->prefix('listings')->name('listings.')->group(function () {
    Route::get('/', [ListingController::class, 'index'])->name('index');
    Route::get('/create', [ListingController::class, 'create'])->name('create');
    Route::post('/', [ListingController::class, 'store'])->name('store');
    Route::get('/{listing}', [ListingController::class, 'show'])->name('show');
});
