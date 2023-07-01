<?php

namespace App\Http\Controllers\Rest\V1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Caso;

class ChoroplethMapRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function showRegionMap(Request $request)
    {
        $regions = \App\KeyValueStorage::where('key', 'geojsonRegions')->first();
        if($regions) {
            return response($regions->value, 200)->header('Content-Type', 'application/json');
        }
        return response('No se ha subido un mapa de departamentos', 404);
    }

    public function showDistrictMap(Request $request)
    {
        $districts = \App\KeyValueStorage::where('key', 'geojsonDistricts')->first();
        if($districts) {
            return response($districts->value, 200)->header('Content-Type', 'application/json');
        }
        return response('No se ha subido un mapa de distritos', 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // error_log($request);
        // error_log($id);

        $initialYear = $request->input('InitialYear'); // Required
        $finalYear = 2022; // $request->input('FinalYear'); // Required
        $initialEpiweek = $request->input('InitialEpiweek'); // Required
        $finalEpiweek = $request->input('FinalEpiweek'); // Required

        // select Latitud, Longitud from pnvev_casos where Year = $initialYear and SemanaEpidemiologica between (1, 53) and EnfermedadId = ?;
        $model = \App\DiseaseV2::find($id);
        // error_log($model->leafs()->map(function($model) { return $model->id; }));
        $leafs = $model->leafs();
        $leafs_ids = $leafs->map(function($item, $key) {
            return $item->id;
        });
        $leafs_ids->push($model->id);
        $leafs_ids = $leafs_ids->toArray();

        $query = Caso::query();
        $query->addSelect(['Latitud', 'Longitud']);

        $query = $query
            ->whereIn('EnfermedadId',$leafs_ids)
            ->where('Year', '=', $initialYear)
            ->where('SemanaEpidemiologica', '>=', 1)
            ->where('SemanaEpidemiologica', '<=', 53);

        // error_log($query->toSql());

        $results = $query->get();

        return response()->json($results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
