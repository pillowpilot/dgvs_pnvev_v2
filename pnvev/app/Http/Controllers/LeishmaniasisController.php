<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LeishmaniasisController extends Controller
{
    public function index(Request $request, $subDiseaseParam)
    {
        $activeMenuItem = 'leishmaniasis-' . $subDiseaseParam;
        $diseaseFullName = 'LEISHMANIASIS ' . strtoupper($subDiseaseParam);
        return view('disease', [
            'active' => $activeMenuItem,
            'diseaseFullName' => $diseaseFullName
        ]);
    }
}
