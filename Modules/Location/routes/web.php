<?php
use Illuminate\Support\Facades\Route;

Route::get('/locations/cities/{country}', function(\Modules\Location\Models\Country $country) {
    return response()->json(
        $country->cities()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'country_id'])
    );
})->name('locations.cities');

Route::get('/locations/districts/{city}', function(\Modules\Location\Models\City $city) {
    return response()->json($city->districts);
})->name('locations.districts');
