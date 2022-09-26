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
        $orphanDiseases = \App\Disease::orphan()->get();
        $diseaseFamilies = \App\DiseaseFamily::all();
        // $diseaseFamilies = [];
        // foreach (\App\DiseaseFamily::all() as $diseaseFamily) {
        //     $diseaseFamilies[] = $diseaseFamily->diseases()->get();
        // }
        // $diseaseFamilies = \App\DiseaseFamily::all()->diseases()->get();

        // return response()->json($diseaseFamilies);

        $model = \App\Disease::find($id);
        if ($model) {
            return view('disease', [
                'activeId' => $id,
                'orphanDiseases' => $orphanDiseases,
                'diseaseFamilies' => $diseaseFamilies,

                // 'active' => 'leishmaniasis-cutanea', 
                'diseaseFullName' => $model->name,
                'diseaseId' => $id]);
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
