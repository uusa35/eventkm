<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CountryLightResource;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Country::active()->has('currency', '>', 0)->with('currency')->has('governates', '>', 0)->has('governates.areas','>', 0)->with('governates.areas')->get();

        if ($elements->isNotEmpty()) {
            return response()->json(CountryLightResource::collection($elements), 200);
        }
        return response()->json(['message' => trans('message.no_countries')], 400);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $element = Country::active()->whereId($id)->with('currency', 'areas')->first();
        if ($element) {
            return response()->json(new CountryLightResource($element), 200);
        }
        return response()->json(['message' => trans('general.country_does_not_exist')], 400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUserCountry()
    {
        $element = Country::where('is_local', true)->with('currency', 'governates.areas')->first();
        return response()->json(new CountryLightResource($element), 200);
        if (app()->isLocal()) {
            $user_ip = array_random(['188.70.48.243', '176.17.238.199', '109.177.176.229']);
        } else {
            $user_ip = app()->isLocal() ? '188.70.48.243' : get_client_ip();
        }
        $geo = unserialize(file_get_contents("https://www.geoplugin.net/php.gp?ip=$user_ip"));
        $country = $geo["geoplugin_countryName"];
        $city = $geo["geoplugin_city"];
        $region = $geo["geoplugin_region"];
        if (request()->has('country_id')) {
            $clientCountry = Country::where(['id' => request()->country_id, 'active' => true])->with('currency', 'areas')->first();
            return response()->json(new CountryLightResource($clientCountry), 200);
        } else {
            $clientCountry = $country ? Country::where('name', $country)->with('currency', 'areas')->first() : Country::where(['is_local', true])->with('currency', 'areas')->first();
            if ($clientCountry) {
                return response()->json(new CountryLightResource($clientCountry), 200);
            }
        }
        return response()->json(['message' => trans('message.no_country')], 400);
    }
}
