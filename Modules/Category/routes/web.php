<?php

declare(strict_types=1);
use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;

Route::middleware('web')->group(function (): void {
    Route::prefix('categories')->name('categories.')->group(function (): void {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
    });
});
