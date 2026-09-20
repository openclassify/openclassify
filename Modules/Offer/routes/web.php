<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Offer\Http\Controllers\OfferController;

Route::middleware(['web', 'auth'])->group(function (): void {
    Route::get('/panel/offers', [OfferController::class, 'index'])->name('panel.offers.index');

    Route::name('offers.')->group(function (): void {
        Route::post('/listings/{listing}/offers', [OfferController::class, 'store'])
            ->whereNumber('listing')
            ->middleware('throttle:20,1')
            ->name('store');

        Route::post('/offers/{offer}/accept', [OfferController::class, 'accept'])->name('accept');
        Route::post('/offers/{offer}/decline', [OfferController::class, 'decline'])->name('decline');
        Route::post('/offers/{offer}/withdraw', [OfferController::class, 'withdraw'])->name('withdraw');
    });
});
