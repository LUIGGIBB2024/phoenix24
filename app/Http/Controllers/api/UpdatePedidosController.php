<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class UpdatePedidosController extends Controller
{
    public function ProcessCxp(Request $request):JsonResponse
    {
        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Salida Exitosa',
            ],Response::HTTP_ACCEPTED);
    }
}
