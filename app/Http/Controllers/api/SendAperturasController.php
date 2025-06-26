<?php

namespace App\Http\Controllers\api;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use App\Models\Aperturadeservicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SendAperturasController extends Controller
{
    public function SendAperturas(Request $request):JsonResponse
    {
        $aperturas = json_decode($request->aperturas);
        //$aperturas = ($request->aperturas);

        foreach ($aperturas as $servicio)
        {
            //$fecha      = $servicio['fechareporte'];
            //$tipo       = $servicio['tipo'];
            //$idregistro = $servicio['id'];
            
            $fecha      = $servicio->fechareporte;
            $tipo       = $servicio->tipo;
            $idregistro = $servicio->id;
            $vendedor   = $servicio->vendedor;
            try 
            {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');              
                $registro = Aperturadeservicio::updateOrCreate(['fechareporte' => $fecha, 'tipo' => $tipo, 'idregistro' => $idregistro],
                    [                 
                        'numerodeservicios'  => $servicio->numerodeservicios,
                        'totalservicios'     => $servicio->totalservicios,
                        'totalcomisiones'    => $servicio->totalcomisiones,
                        'observaciones'      => $servicio->observaciones,
                        'tipo'               => $tipo,
                        'vendedor'           => $vendedor,
                        'estado'             => $servicio->estado, // Assuming estado is always 1 for active
                        'estado2'            => $servicio->estado2, // Assuming
                        'usuario_created'    => Auth::user()->codigo,
                        'usuario_updated'    => Auth::user()->codigo,               
                    ]
                );
                
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            } catch (\Exception $e) {
                return response()->json(
                    [
                     'status'           => '400',
                     'msg'              => 'Error al actualizar la apertura de servicios '.$e->getMessage(),
                    ],Response::HTTP_BAD_REQUEST);
            }
        }

        return response()->json(
            [
               'status'          => '200',
               'msg'             => 'Actualización de Aperturas Existosa',
            ],Response::HTTP_ACCEPTED);
    }

}
