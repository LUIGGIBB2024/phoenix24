<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\cliente;
use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon as SupportCarbon;

class UpdatePedidosController extends Controller
{
    public function UpdatePedidos(Request $request):JsonResponse
    {
        
        $pedidos = json_decode($request->pedidos);  
        
        //$pedidos = $request->pedidos;  
        
        $cuantos = 0;

        // return response()->json(
        //     [
        //      'status'           => '202',
        //      'msg'              => 'Actualización no Exitosa',
        //      'request'          => $request->all(),
        //     ],Response::HTTP_ACCEPTED);

        foreach ($pedidos as $pedido)
         {

            $cuantos++;            
            $consecutivo    = $pedido->id;
            $nit            = $pedido->identificacion;
            $sucursal       = ""; 
            $fecha          = $pedido->fechadepedido; 
           
            //$fechaLapso     = Carbon::now();

            //$fecha = '2025-04-20'; // o cualquier otra fecha
            $fechaLapso = Carbon::parse($fecha);
            
            return response()->json(
                [
                 'status'           => '202',
                 'msg'              => 'Voy Aquí Antes dddd',
                ],Response::HTTP_ACCEPTED);
            $ano            = $fechaLapso->format('Y'); 
            $$mes           = $fechaLapso->format('m');  

            $lapso         =  $ano . "-" . $mes;

            $cliente        = cliente::where('nit',$nit)->where('sucursal','01')->get();


            $reg_pedidos = Pedido::updateOrCreate(['consecutivo'=>$consecutivo,'fechadocumento'=>$fecha,'nit'=>$nit,'sucursal'=>$sucursal],
            [
                'tipodedocumento'       => $pedido->codigopedido,
                'ncargue'               => 0,
                'horadepedido'          => "00:00:00",
                'nitaseguradora'        => "",
                'sucursalaseg'          => "",
                'nombreventa'           => $pedido->nombre, 
                'nombres'               => $pedido->nombres,  
                'apellidos'             => $pedido->apellidos,           
                'numerodepoliza'        => " ",
                'numerodesiniestro'     => " ",
                'fechadeentrega'        => $fecha,
                'horadeentrega'         => "00:00:00",
                'direcciondeentrega'    => $pedido->direccion, 
                'telefonodeentrega'     => $pedido->telefono,   
                'reportedelcliente'     => " ",
                'numerodeorden'         => " ",
                'vendedor'              => $pedido['vendedor'],
                'rutadeventa'           => $cliente->rutadeventa,
                'zonadeventa'           => $cliente->zonadeventa,
                'transportador'         => "",
                'tipocliente'           => $cliente->tipodecliente,
                'kilometraje'           => 0,
                'placa'                 => "",
                'numerodocumento'       => "",
                'tipodepago'            => "",
                'valorpedido'           => $pedido->valorpedido, 
                'dsctosproductos'       => 0,
                'dsctosadicionales'     => 0,
                'lapso'                 => $lapso,
                'valoriva'              => $pedido->valoriva,  
                'retefuente'            => $pedido->valorretefuente,   
                'reteiva'               => $pedido->valorreteiva,                   
                'reteica'               => $pedido->valorreteica, 
                'valoradicional'        => 0,
                'totalpedido'           => $pedido->totalpedido,  
                'costodeventa'          => 0,
                'valorotrodocumento'    => 0,
                'proyecto'              => "",
                'sproyecto'             => "",
                'centrooper'            => "",
                'actividad'             => "",
                'estado'                => 1,
                'estado01'              => 0,
                'estado02'              => 0,
                'reportedeltecnico'     => "",
                'mesa'                  => "",
                'caja'                  => "",
                'cajero'                => "",
                'tecnico'               => "",
                'lista'                 => "",
                'latitud'               => 0.00,
                'longitud'              => 0.00,
                'email'                 => $pedido->email,   
                'ciudad'                => $pedido->ciudad,   
                'usuario_created'       =>"PHOENIX",
                'usuario_updated'       =>"PHOENIX",                
            ]);
        }
        if ($cuantos > 0)
        {
            return response()->json(
                [
                 'status'           => '202',
                 'msg'              => 'No se encontraron pedidos para actualizar',
                ],Response::HTTP_BAD_REQUEST);
        } else
        return response()->json(
            [
             'status'           => '202',
             'msg'              => 'Actualización no Exitosa',
            ],Response::HTTP_ACCEPTED);
    }
}
