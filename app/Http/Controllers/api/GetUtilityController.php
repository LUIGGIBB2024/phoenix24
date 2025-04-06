<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Lista;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class GetUtilityController extends Controller
{
    public function getUtility()
    {
        $listas = Lista::all();
        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Listas de Precios',
             'listas    '        => $listas,
            ],Response::HTTP_ACCEPTED);        
    }
}
