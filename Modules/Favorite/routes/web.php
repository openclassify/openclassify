<?php

use Illuminate\Support\Facades\Route;
use Modules\Favorite\App\Http\Controllers\FavoriteController;

Route::middleware('auth')->prefix('favorites')->name('favorites.')->group(function () {
    Route::get('/', [FavoriteController::class, 'index'])->name('index');
    Route::post('/listings/{listing}/toggle', [FavoriteController::class, 'toggleListing'])->name('listings.toggle');
    Route::post('/sellers/{seller}/toggle', [FavoriteController::class, 'toggleSeller'])->name('sellers.toggle');
    Route::post('/searches', [FavoriteController::class, 'storeSearch'])->name('searches.store');
    Route::delete('/searches/{favoriteSearch}', [FavoriteController::class, 'destroySearch'])->name('searches.destroy');
});
