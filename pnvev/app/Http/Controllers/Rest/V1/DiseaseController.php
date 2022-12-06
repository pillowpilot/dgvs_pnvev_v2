<?php

namespace App\Http\Controllers\Rest\V1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(\App\Disease::all());
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = \App\DiseaseV2::find($id);
        if ($model) 
            return response()->json($model);
        else {
            return response()->json(['error' => 'Not found'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showWithAgeGroups($id)
    {
        $model = \App\DiseaseV2::find($id);
        if ($model) {
            return response()->json(['error' => 'TBI'], 500);
        }
        else
        {
            return response()->json(['error' => 'Not found'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showWithYears($id)
    {
        $model = \App\DiseaseV2::find($id);
        if ($model) {
            $leafs = $model->leafs();
            // error_log($leafs);

            $leafs_ids = $leafs->map(function($item, $key) {
                return $item->id;
            });
            $leafs_ids->push($model->id);
            $leafs_ids = $leafs_ids->toArray();

            // error_log($leafs_ids);
            // error_log(gettype(array($leafs_ids)));

            return response()->json(
                \App\Caso::select('Year')
                ->distinct()
                ->whereIn('EnfermedadId', $leafs_ids)
                ->orderBy('Year')
                ->get());
        }
        else
        {
            return response()->json(['error' => 'Not found'], 404);
        }
    }

    // public function showMaxYear($id)
    // {
    //     $model = \App\DiseaseV2::find($id);
    //     if ($model) {
    //         return response()->json(
    //             \App\Caso::whereIn('EnfermedadId', collect($model->leafs())->map(function ($item, $key) { return $item->id; }))
    //             ->max('Year'));
    //     }
    //     else
    //     {
    //         return response()->json(['error' => 'Not found'], 404);
    //     }
    // }

    // public function showMinYear($id)
    // {
    //     $model = \App\DiseaseV2::find($id);
    //     if ($model) {
    //         return response()->json(
    //             \App\Caso::whereIn('EnfermedadId', $model->leafs()->map(function ($item, $key) { return $item->id; }))
    //             ->min('Year'));
    //     }
    //     else
    //     {
    //         return response()->json(['error' => 'Not found'], 404);
    //     }
    // }

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
