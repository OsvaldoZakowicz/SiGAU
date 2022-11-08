<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class SearchLocalidadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $search = $request->search;

        if ($search !== "") {
            $locations = DB::table('locations')
                ->join('provinces', 'province_id', '=', 'provinces.id')
                ->join('countries', 'country_id', '=', 'countries.id')
                ->where('locations.name', 'like', '%' . $search . '%')
                ->orWhere('locations.postal_code', 'like', '%' . $search . '%')
                ->select('locations.id', 'locations.name', 'locations.postal_code', 'provinces.name as province', 'countries.name as country')
                ->limit(10)
                ->get();
        }

        $response = array();

        foreach ($locations as $location) {
            $response[] = array(
                "id" => $location->id,
                "text" => 'localidad: ' . $location->name . ' codigo postal: ' . $location->postal_code . ' provincia: ' . $location->province . ' pais: ' . $location->country
            );
        }

        return response()->json($response);
    }
}
