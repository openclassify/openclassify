<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Favorite\App\Http\Controllers\FavoriteController;

Route::middleware('web')->group(function (): void {
    Route::prefix('favorites')->name('favorites.')->group(function (): void {
        Route::get('/', [FavoriteController::class, 'index'])->name('index');
    });

    Route::middleware('auth')->prefix('favorites')->name('favorites.')->group(function (): void {
        Route::post('/listings/{listing}/toggle', [FavoriteController::class, 'toggleListing'])->name('listings.toggle');
        Route::post('/sellers/{seller}/toggle', [FavoriteController::class, 'toggleSeller'])->name('sellers.toggle');
        Route::post('/searches', [FavoriteController::class, 'storeSearch'])->name('searches.store');
        Route::delete('/searches/{favoriteSearch}', [FavoriteController::class, 'destroySearch'])->name('searches.destroy');
    });
});
