<?php

namespace App\Http\Controllers\api;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendAperturasController extends Controller
{
    public function SendAperturas(Request $request):JsonResponse
    {
        $aperturas = json_decode($request->aperturas);

        foreach ($aperturas as $servicio)
        {
            

        }



        return response()->json(
            [
               'status'          => '200',
               'msg'             => 'Actualización de Aperturas Existosa',
            ],Response::HTTP_ACCEPTED);



    }

}
