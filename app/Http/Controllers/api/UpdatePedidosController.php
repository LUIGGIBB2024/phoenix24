<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\cliente;
use App\Models\Detalledepedido;
use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
           
            $ano           = $fechaLapso->format('Y'); 
            $mes           = $fechaLapso->format('m');  
            $lapso         = $ano . $mes;                

            $cliente       = cliente::where('nit',$nit)->where('sucursal','01')->first();   
            $ruta          = $cliente ->rutadeventa; 
            $zona          = $cliente ->zonadeventa;
            $tipocliente   = $cliente ->tipodecliente;
            $lista         = $cliente->lista;
            $sucursal      = $pedido->sucursal;

            try {
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
                        'vendedor'              => $pedido->vendedor,
                        'rutadeventa'           => $ruta,
                        'zonadeventa'           => $zona,
                        'transportador'         => "",
                        'tipocliente'           => $tipocliente,
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
                        'estado02'              => $pedido->estado02,
                        'reportedeltecnico'     => "",
                        'mesa'                  => "",
                        'caja'                  => "",
                        'cajero'                => "",
                        'tecnico'               => "",
                        'lista'                 => $lista,
                        'latitud'               => 0.00,
                        'longitud'              => 0.00,
                        'email'                 => $pedido->email,   
                        'ciudad'                => $pedido->ciudad,   
                        'observaciones'         => is_null($pedido->observaciones)?"":$pedido->observaciones,
                        'usuario_created'       => Auth::user()->codigo,
                        'usuario_updated'       => Auth::user()->codigo,               
                    ]);
            } catch (\Exception $e) {
                return response()->json(
                    [
                     'status'           => '400',
                     'msg'              => 'Error al actualizar el pedido: '.$e->getMessage(),
                    ],Response::HTTP_BAD_REQUEST);
            }
        }
        if ($cuantos == 0)
        {
            return response()->json(
                [
                 'status'           => '204',
                 'msg'              => 'No se encontraron pedidos para actualizar',
                ],Response::HTTP_NO_CONTENT);
        } else
        return response()->json(
            [
             'status'           => '202',
             'msg'              => 'Actualización de Pedidos Exitosa',
            ],Response::HTTP_ACCEPTED);
    }

    public function UpdateDetPedidos(Request $request):JsonResponse
    {
        $detpedidos = json_decode($request->detpedidos); 
        
        foreach ($detpedidos as $detpedido)
        {
            $consecutivo    = $detpedido->idpedido;
            $nit            = $detpedido->identificacion;
          
            $fecha          = $detpedido->fechadepedido;

            $fechaLapso = Carbon::parse($fecha);         
           
            $ano            = $fechaLapso->format('Y'); 
            $mes           = $fechaLapso->format('m');  
            $lapso         =  $ano . $mes;  

            $producto       = $detpedido->codigo;
            $bodega         = $detpedido->bodega;

            $cliente        = cliente::where('nit',$nit)->where('sucursal','01')->first();   
            $ruta           = $cliente ->rutadeventa; 
            $zona           = $cliente ->zonadeventa;
            $tipocliente    = $cliente ->tipodecliente;
            $tipodcto       = $detpedido->tipodocumento;
            $lista          = $cliente->lista;
            $sucursal       = $detpedido->sucursal;
            $sucursal       = is_null($sucursal)?"":$sucursal;

            try 
            {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');              
                $registro = Detalledepedido::updateOrCreate(['consecutivo'=>$consecutivo,'tipodedocumento'=> $tipodcto,'fechadocumento'=>$fecha,'producto'=>$producto,'bodega'=>$bodega],
                [
                    'nit'                   => $nit,
                    'sucursal'              => $sucursal,
                    'proyecto'              => "",
                    'sproyecto'             => "",
                    'centrooper'            => "",
                    'actividad'             => "",
                    'placa'                 => "",
                    'lapso'                 => $lapso,
                    'nittercero'            => "",
                    'rutadeventa'           => $ruta,
                    'zonadeventa'           => $zona,
                    'tipocliente'           => $tipocliente,   
                    'vendedor'              => $detpedido->vendedor,   
                    'lista'                 => $lista,
                    'tecnico'               => "",
                    'serial'                => "",
                    'garantia'              => 0,
                    'descripcion'           => $detpedido->descripcionproducto,  
                    'lote'                  => "",
                    'concepto'              => "",
                    'cptoclase'             => "",
                    'ncargue'               => 1,
                    'pedidosid'             => $detpedido->idpedido,
                    'cantidad'              => $detpedido->cantidad, 
                    'cantidad2'             => 0,
                    'valor'                 => $detpedido->valor1,
                    'descuento1'            => $detpedido->descuento1,
                    'descuento2'            => $detpedido->descuento2,
                    'descuento3'            => 0,
                    'iva'                   => $detpedido->iva,  
                    'costopromedio'         => 0,  
                    'fechadevencimiento'    => $fecha, 
                    'estado'                => 1,
                    'estado01'              => 0,
                    'estado02'              => 0,  
                    'valorreal'             => $detpedido->valor1,  
                    'usuario_created'       => Auth::user()->codigo,
                    'usuario_updated'       => Auth::user()->codigo,               
                ]);
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            } catch (\Exception $e) {
                return response()->json(
                    [
                     'status'           => '400',
                     'msg'              => 'Error al actualizar el Detalle del pedido: '.$e->getMessage(),
                    ],Response::HTTP_BAD_REQUEST);
            }
        }

        //////// Validación de Número de Registros Actualizados ////////// 
        if (count($detpedidos) == 0)
        {
            return response()->json(
                [
                 'status'           => '204',
                 'msg'              => 'No se encontraron pedidos para actualizar',
                ],Response::HTTP_NO_CONTENT);
        } 
        else
            return response()->json(
                [
                'status'           => '202',
                'msg'              => 'Actualización de del Detalle de Pedidos Exitosa',
                ],Response::HTTP_ACCEPTED);          
    }
}
