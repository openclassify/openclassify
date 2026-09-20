<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Promotion\Http\Controllers\PromotionController;

Route::middleware('web')->group(function (): void {
    Route::get('/promotions', [PromotionController::class, 'plans'])->name('promotions.plans');

    Route::middleware('auth')->prefix('panel')->name('panel.promotions.')->group(function (): void {
        Route::get('/promotions', [PromotionController::class, 'index'])->name('index');
        Route::post('/promotions', [PromotionController::class, 'store'])->name('store');
    });
});
