<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class GetUtilityController extends Controller
{
    public function getUtility(Request $request)
    {
        //$listas = List
        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Ventas Diarias Consolidadas Año ('. $anop .')',
             'listas    '        => $listas,
            ],Response::HTTP_ACCEPTED);
        
    }
}
