<?php

use Illuminate\Support\Facades\Route;
use Modules\Location\Http\Controllers\LocationLookupController;

Route::middleware('web')->group(function () {
    Route::get('/locations/cities/{country}', [LocationLookupController::class, 'cities'])
        ->name('locations.cities');
    Route::get('/locations/districts/{city}', [LocationLookupController::class, 'districts'])
        ->name('locations.districts');
});
