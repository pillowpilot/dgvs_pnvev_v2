<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return view('admin.user', ['user' => $user]);
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
    public function storeName(Request $request)
    {
        $user = $request->user();
        $user->name = $request->input('name');
        $user->save();
        return view('admin.user', ['user' => $user, 'nameStatusMessageText' => 'Guardado']);
    }

    public function storeEmail(Request $request)
    {
        //TODO Check if email is already in use
        $new_email = $request->input('email');
        if(\App\User::where('email', $new_email)->count() > 0){
            return view('admin.user', ['user' => $request->user(), 'emailStatusMessageText' => 'Email ya en uso']);
        }

        $user = $request->user(); 
        $user->email = $request->input('email');
        $user->save();
        return view('admin.user', ['user' => $user, 'emailStatusMessageText' => 'Guardado']);
    }

    public function storePassword(Request $request)
    {
        if($request->input('password_new') != $request->input('password_new_confirmation')){
            return view('admin.user', ['user' => $request->user(), 'passwordStatusMessageText' => 'Las contraseñas no coinciden']);
        } else if(strlen($request->input('password_new')) < 6){
            return view('admin.user', ['user' => $request->user(), 'passwordStatusMessageText' => 'La contraseña nueva debe tener al menos 6 caracteres']);
        } else if(
            ! \Hash::check($request->input('password_old'), $request->user()->password)
            ){
            return view('admin.user', ['user' => $request->user(), 'passwordStatusMessageText' => 'La contraseña actual no es correcta']);
        } else {
            $user = $request->user();
            $user->password = \Hash::make($request->input('password_new'));
            $user->save();
            return view('admin.user', ['user' => $user, 'passwordStatusMessageText' => 'Guardado']);
        }
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
