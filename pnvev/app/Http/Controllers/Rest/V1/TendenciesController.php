<?php

namespace App\Http\Controllers\Rest\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Caso;

class TendenciesController extends Controller
{
    public function index(Request $request, $id)
    {
        $ageGroup = $request->input('GrupoEtareo'); // Optional
        $gender = $request->input('Sexo'); // Optional
        $groupByFields = $request->get('groupBy', []); // Optional

        $initialYear = $request->input('InitialYear'); // Required
        $finalYear = $request->input('FinalYear'); // Required
        $initialEpiweek = $request->input('InitialEpiweek'); // Required
        $finalEpiweek = $request->input('FinalEpiweek'); // Required

        if (!$initialYear || !$finalYear || !$initialEpiweek || !$finalEpiweek) 
            return response()->json(['error' => 'Missing parameters'], Response::HTTP_BAD_REQUEST);

        if ($request->has('Sexo') && array_search('Sexo', $groupByFields) !== false) 
            return response()->json(['error' => 'Sexo cannot be a query parameter and a groupBy parameter at the same time'], 
                Response::HTTP_BAD_REQUEST);

        if ($request->has('GrupoEtareo') && array_search('GrupoEtareo', $groupByFields) !== false) 
            return response()->json(['error' => 'GrupoEtareo cannot be a query parameter and a groupBy parameter at the same time'], 
                Response::HTTP_BAD_REQUEST);

        $query = Caso::query();
        
        $query = $query
            ->addSelect('Year');

        if (array_search('SemanaEpidemiologica', $groupByFields) !== false) {
            $query = $query
                ->addSelect('SemanaEpidemiologica')
                ->groupBy('SemanaEpidemiologica');
        }

        $query = $query
            ->selectRaw('count(*) as Total')
            ->where('EnfermedadId', $id);

        if ($request->has('GrupoEtareo')) {
            $query = $query
                ->where('GrupoEtareo', $ageGroup);
        } else if (array_search('GrupoEtareo', $groupByFields) !== false) {
            $query = $query
                ->addSelect('GrupoEtareo')
                ->groupBy('GrupoEtareo');
        } else if (array_search('RegionAdministrativaId', $groupByFields) !== false ) {
            $query = $query
                ->addSelect('RegionAdministrativaId')
                ->groupBy('RegionAdministrativaId');
        }

        if ($request->has('Sexo')) {
            $query = $query
                ->where('Sexo', $gender);
        } else if (array_search('Sexo', $groupByFields) !== false) {
            $query = $query
                ->addSelect('Sexo')
                ->groupBy('Sexo');
        }

        $query = $query
            ->where('Year', '>=', $initialYear)
            ->where('Year', '<=', $finalYear)
            ->where('SemanaEpidemiologica', '>=', $initialEpiweek)
            ->where('SemanaEpidemiologica', '<=', $finalEpiweek);

        $results = $query->get();

        return response()->json($results);
    }
}
