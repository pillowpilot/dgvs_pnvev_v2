<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DiseaseV2Controller extends Controller
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = \App\DiseaseV2::find($id);
        error_log($model->children()->get());

        $current_epiweek = \DB::table('pnvev_epiweek')
            ->select('SemanaEpidemiologica')
            ->where('Inicio', '<=', date('Y-m-d'))
            ->where('Fin', '>=', date('Y-m-d'))
            ->first();

        if($current_epiweek) {
            $current_epiweek = $current_epiweek->SemanaEpidemiologica;
        } else {
            $current_epiweek = -1;
        }

        if ($model) {
            return view('disease', [
                'activeDisease' => $model,

                'diseaseFullName' => $model->name,
                'diseaseId' => $id,
                'diseaseChildren' => $model->children()->get(),
                'diseaseCaseDescription' => $model->case_description,

                'epiweek' => $current_epiweek,
                'tendenciesTitle' => $model->tendencies_title,
                'childrenTendenciesTitle' => $model->children_tendencies_title,
                'distributionTitle' => $model->distribution_title,
                'regionsHeatmapTitle' => $model->regions_heatmap_title,
                'districtsHeatmapTitle' => $model->districts_heatmap_title,
            ]);
        } else {
            abort(404); // TODO Remove this line and replace with a 404 page
        }
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
