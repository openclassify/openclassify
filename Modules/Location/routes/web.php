<?php

use Illuminate\Support\Facades\Route;
use Modules\Location\Models\Country;

Route::get('/locations/cities/{country}', function (string $country) {
    $lookupValue = trim($country);

    if ($lookupValue === '') {
        return response()->json([]);
    }

    $lookupCode = strtoupper($lookupValue);
    $lookupName = mb_strtolower($lookupValue);

    $countryModel = Country::query()
        ->where(function ($query) use ($lookupValue, $lookupCode, $lookupName): void {
            if (ctype_digit($lookupValue)) {
                $query->orWhereKey((int) $lookupValue);
            }

            $query
                ->orWhereRaw('UPPER(code) = ?', [$lookupCode])
                ->orWhereRaw('LOWER(name) = ?', [$lookupName]);
        })
        ->first();

    if (! $countryModel) {
        return response()->json([]);
    }

    $activeCities = $countryModel->cities()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'country_id']);

    if ($activeCities->isNotEmpty()) {
        return response()->json($activeCities);
    }

    return response()->json(
        $countryModel->cities()
            ->orderBy('name')
            ->get(['id', 'name', 'country_id'])
    );
})->name('locations.cities');

Route::get('/locations/districts/{city}', function (\Modules\Location\Models\City $city) {
    return response()->json($city->districts);
})->name('locations.districts');
