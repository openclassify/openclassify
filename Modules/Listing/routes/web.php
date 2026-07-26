<?php

declare(strict_types=1);
use Illuminate\Support\Facades\Route;
use Modules\Listing\Http\Controllers\ListingController;

Route::middleware('web')->prefix('listings')->name('listings.')->group(function () {
    Route::get('/', [ListingController::class, 'index'])->name('index');
    Route::get('/create', [ListingController::class, 'create'])->name('create');
    Route::post('/', [ListingController::class, 'store'])->name('store');
    Route::middleware(['auth', 'throttle:30,1'])->get('/{listing}/contact', [ListingController::class, 'contact'])->name('contact');
    Route::get('/{listing}', [ListingController::class, 'show'])->name('show');
});
