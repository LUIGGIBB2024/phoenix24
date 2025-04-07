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
        $productos       = producto::select('productoID','codigo','descripcion','medida','grupo','subgrupo','division','porcentajeiva','valorultimacompra','unidadesxempaque')
                           ->where('estado',1)->where('facturable',1)->get();
        $saldos          = saldosdeinventario::select('saldosdeinventariosID','anodeproceso','producto','cantidad','cantidad1','costopromedio','ultimocosto')->get();  
         
        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Productos de la lista',
             'productos'        => $productos,
             'saldos'           => $saldos,
            ],Response::HTTP_ACCEPTED);
    }
}
