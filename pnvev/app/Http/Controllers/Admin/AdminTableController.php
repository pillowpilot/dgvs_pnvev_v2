<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $selectableTables = [
            'v_pnvev_casos_chagas_agudo' => 'C. Agudo',
            'v_pnvev_casos_chagas_cronico' => 'C. Cronico',
            'v_pnvev_casos_leishmaniasis_visceral' => 'L. Visceral',
            'v_pnvev_casos_leishmaniasis_cutanea' => 'L. Cutanea',
            'v_pnvev_casos_leishmaniasis_mucosa' => 'L. Mucosa',
        ];

        return view('admin.tableSelection', ['user' => $user, 'selectableTables' => $selectableTables]);
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
        // $user = $request->user();
        // \App\KeyValueStorage::updateOrCreate(['key' => 'homePage'], ['value' => $request->input('value')]);
        // return view('admin.home', ['user' => $user, 'submitStatus' => 'ok']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = $request->user();

        $tableName = $request->input('table');
        $tableData = \DB::table($tableName)->get();
        $json = json_encode($tableData);

        return view('admin.table', ['user' => $user, 'tableName' => $tableName, 'json' => $json]);
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
