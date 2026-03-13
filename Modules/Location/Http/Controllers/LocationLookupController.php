<?php

namespace Modules\Location\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Location\Models\City;
use Modules\Location\Models\Country;

class LocationLookupController extends Controller
{
    public function cities(string $country): JsonResponse
    {
        $countryModel = Country::resolveLookup($country);

        if (! $countryModel) {
            return response()->json([]);
        }

        return response()->json($countryModel->cityPayloads());
    }

    public function districts(City $city): JsonResponse
    {
        return response()->json($city->districtPayloads());
    }
}
