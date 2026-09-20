<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Review\Http\Controllers\ReviewController;

Route::middleware(['web', 'auth'])->name('reviews.')->group(function (): void {
    Route::post('/sellers/{seller}/reviews', [ReviewController::class, 'store'])
        ->whereNumber('seller')
        ->middleware('throttle:10,1')
        ->name('store');

    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('destroy');
});
