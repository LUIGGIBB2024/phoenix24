<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\detalledelista;
use App\Models\Lista;
use App\Models\producto;
use App\Models\saldosdeinventario;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class GetUtilityController extends Controller
{
    public function getListas():JsonResponse
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

    public function getProductos(Request $request):JsonResponse
    {
        $productos       = producto::where('estado',1)->get();
        $saldos          = saldosdeinventario::all();   
        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Productos de la lista',
             'productos'        => $productos,
             'saldos'           => $saldos,
            ],Response::HTTP_ACCEPTED);
    }
}
