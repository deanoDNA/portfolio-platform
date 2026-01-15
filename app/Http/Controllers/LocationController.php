<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\District;

class LocationController extends Controller
{
    public function regions($countryId)
    {
        return response()->json(
            Region::where('country_id', $countryId)
                ->orderBy('name')
                ->get()
        );
    }

    public function districts($regionId)
    {
        return response()->json(
            District::where('region_id', $regionId)
                ->orderBy('name')
                ->get()
        );
    }
}
