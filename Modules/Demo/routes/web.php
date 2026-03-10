<?php

use Illuminate\Support\Facades\Route;
use Modules\Demo\App\Http\Controllers\DemoController;

Route::middleware('web')->group(function () {
    Route::post('/demo/prepare', [DemoController::class, 'prepare'])
        ->middleware('throttle:8,1')
        ->name('demo.prepare');
});
