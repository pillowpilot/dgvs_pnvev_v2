<?php

namespace App\Http\Controllers\Rest\V1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Caso;

class FilterPossibleValuesController extends Controller
{
    public function index(Request $request, $filterName)
    {
        $diseaseName = $request->input('TipoEnfermedad');
        
        if ($diseaseName) {
            $cases = Caso::where('TipoEnfermedad', $diseaseName)
                ->select($filterName)
                ->distinct()
                ->orderBy($filterName)
                ->get();
        } else {
            $cases = Caso::select($filterName)
                ->distinct()
                ->get();
        }

        return response()->json($cases);
    }
}
