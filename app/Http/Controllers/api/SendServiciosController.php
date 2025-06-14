<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\reportedeservicios;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SendServiciosController extends Controller
{
    public function UpdateSales(Request $request):JsonResponse
    {
        $servicios = json_decode($request->servicios); 

        foreach ($servicios as $servicio)
        {
            $fecha      = $servicio->fechadereporte;
            $tipo       = $servicio->tipo;
            $idregistro = $servicio->idregistro;
            $producto   = $servicio->producto;

            try 
            {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');              
                $registro = reportedeservicios::updateOrCreate(['fechadereporte'=>$fecha,'tipo'=> $tipo,'idregistro'=>$idregistro,'producto'=>$producto],
                [                 
                    'descripcion'           => $servicio->descripcion,
                    'vendedor'              => $servicio->vendedor,
                    'placa'                 => $servicio->placa,              
                    'cantidad'              => $servicio->cantidad,
                    'valor'                 => $servicio->valor,
                    'comision'              => $servicio->comision,
                    'porcentaje'            => $servicio->porcentaje,
                    'observaciones'         => $servicio->observaciones,
                    'tipo'                  => $tipo,
                    'estado'                => 1, // Assuming estado is always 1 for active
                    'usuario_created'       => Auth::user()->codigo,
                    'usuario_updated'       => Auth::user()->codigo,               
                ]);
                
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            } catch (\Exception $e) {
                return response()->json(
                    [
                     'status'           => '400',
                     'msg'              => 'Error al actualizar el reporte de servicios '.$e->getMessage(),
                    ],Response::HTTP_BAD_REQUEST);
            }



        }


        return response()->json(
            [
               'status'          => '200',
               'msg'             => 'Actualización de Servicios Existosa',
            ],Response::HTTP_ACCEPTED);
    }    
      

}
