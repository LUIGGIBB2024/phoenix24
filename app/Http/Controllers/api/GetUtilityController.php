<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\detalledelista;
use App\Models\Lista;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class GetUtilityController extends Controller
{
    public function getListas()
    {
        $listas         = Lista::all();
        $detlistas      = detalledelista::all();
        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Listas de Precios',
             'listas'           => $listas,
             'detlistas'        => $detlistas,
            ],Response::HTTP_ACCEPTED);        
    }
}
