<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminMapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return view('admin.maps', ['user' => $user]);
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
    public function storeDistrictMap(Request $request)
    {
        $user = $request->user();
        $file = $request->file('file');
        $maxFileSize = 3 * 1024 * 1024; // 3MB
        if($file->getSize() > $maxFileSize) {
            return view('admin.maps', ['user' => $user, 'districtsStatusMessageText' => 'Archivo supera el tamaño máximo de 3MB']);
        }
        $contents = file_get_contents($file->getRealPath());
        \App\KeyValueStorage::updateOrCreate(['key' => 'geojsonDistricts'], ['value' => $contents]);
        return view('admin.maps', ['user' => $user, 'districtsStatusMessageText' => 'Mapa de distritos subido correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
