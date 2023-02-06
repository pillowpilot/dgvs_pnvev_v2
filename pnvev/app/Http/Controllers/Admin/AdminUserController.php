<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeName(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|alpha_dash|between:1,20|unique:pnvev_users,name',
        ]);

        $user = $request->user();
        $user->name = $request->input('name');
        $user->save();
        return view('admin.user', ['user' => $user, 'nameStatusMessageText' => 'Guardado']);
    }

    public function storeEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|alpha_dash|between:5,20|unique:pnvev_users,email',
        ]);

        $user = $request->user(); 
        $user->email = $request->input('email');
        $user->save();
        return view('admin.user', ['user' => $user, 'emailStatusMessageText' => 'Guardado']);
    }

    public function storePassword(Request $request)
    {
        $this->validate($request, [
            'password_old' => 'required',
            'password_new' => 'required|between:6,20|confirmed', // confirmed requires the field password_new_confirmation
        ]);

        if(! \Hash::check($request->input('password_old'), $request->user()->password)){
            return view('admin.user', ['user' => $request->user(), 'passwordStatusMessageText' => 'La contraseña actual no es correcta']);
        } else {
            $user = $request->user();
            $user->password = \Hash::make($request->input('password_new'));
            $user->save();
            return view('admin.user', ['user' => $user, 'passwordStatusMessageText' => 'Guardado']);
        }
    }

}
