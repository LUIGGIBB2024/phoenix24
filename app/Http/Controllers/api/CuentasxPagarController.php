<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;



class CuentasxPagarController extends Controller
{
    public function ProcessCxp(Request $request):JsonResponse
    {
        if (isset($request->datacxp))
        {
            $cxp = $request->datacxp;
        }

        return response()->json(
            [
            'status'       => '200',
            'msg'          => 'Actualización Exitosa',
            ],Response::HTTP_ACCEPTED);
    }
}
