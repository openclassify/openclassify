<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Report\Http\Controllers\ReportController;

Route::middleware(['web', 'auth', 'throttle:10,1'])->group(function (): void {
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
});
