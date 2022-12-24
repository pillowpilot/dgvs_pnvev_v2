<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DiseaseV2Controller extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = \App\DiseaseV2::findOrFail($id); // Throws ModelNotFoundException

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
    }
}
