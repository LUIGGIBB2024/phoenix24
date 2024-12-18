<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\cuentasporpagar;
use App\Models\egreso;
use App\Models\proveedor;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;



class CuentasxPagarController extends Controller
{
    public function ProcessCxp(Request $request):JsonResponse
    {
        if (isset($request->dataegresos))
        {
            $pagos = $request->dataegresos;

            foreach ($pagos as $dato)
            {
                $consecutivo =  $dato['consecutivo'];
                $tipodocto   =  !is_null($dato['documentodepago'])?$dato['documentodepago']:"";
                $lapso       =  !is_null($dato['lapso'])?$dato['lapso']:"";
                $fechadcto   =  $dato['fechadocumento'];
                $reg_pagos   =  egreso::updateOrCreate(['consecutivo'=>$consecutivo,'tipodedocumento'=>$tipodocto,'lapso'=>$lapso,'fechadocumento'=>$fechadcto],
                [
                   
                    'nit'                     =>  !is_null($dato['nit'])?$dato['nit']:"",
                    'sucursal'                =>  !is_null($dato['sucursal'])?$dato['sucursal']:"",
                    'nombredeltercero'        =>  !is_null($dato['nombredeltercero'])?$dato['nombredeltercero']:"",
                    'tipodeegreso'            =>  $dato['estado01'],
                    'tipodepago'              =>  $dato['tipopago'],
                    'valorcxp'                =>  $dato['valorcxp'],
                    'otrospagos'              =>  $dato['valoradicional'],
                    'fechadelcheque'          =>  $dato['fechadelcheque'],
                    'fechadeentrega'          =>  $dato['fechadeentrega'],
                    'banco'                   =>  !is_null($dato['banco'])?$dato['banco']:"",
                    'numerodecheque'          =>  !is_null($dato['numerodecheque'])?$dato['numerodecheque']:"",
                    'proyecto'                =>  !is_null($dato['proyecto'])?$dato['proyecto']:"",
                    'sproyecto'               =>  !is_null($dato['sproyecto'])?$dato['sproyecto']:"",
                    'centrooper'              =>  !is_null($dato['centrooper'])?$dato['centrooper']:"",
                    'actividad'               =>  !is_null($dato['actividad'])?$dato['actividad']:"",
                    'enlacectb'               =>  !is_null($dato['cptointerface'])?$dato['cptointerface']:"",
                    'observaciones'           =>  !is_null($dato['observaciones'])?$dato['observaciones']:"",
                    'estado'                  =>  $dato['estado'],
                    'estado01'                =>  $dato['estado01'],
                    'estado02'                =>  $dato['estado02'],
                    'estado03'                =>  $dato['estado03'],
                    'usuario_created'         =>  $dato['usuariocreated'],
                    'usuario_updated'         =>  $dato['usuarioupdated'],
                ]);
            }

            return response()->json(
                [
                'status'       => '200',
                'msg'          => 'Actualización Exitosa 200',
                ],Response::HTTP_ACCEPTED); 
        }
        
        if (isset($request->datacxp))
        {
            $cxp = $request->datacxp;
            $contador = 0;
            foreach ($cxp as $dato)
            {
              $nit          =   !is_null($dato['nit'])?$dato['nit']:"";
              $sucursal     =   !is_null($dato['sucursal'])?$dato['sucursal']:"";
              $prefijo      =   !is_null($dato['prefijo'])?$dato['prefijo']:"";
              $tipodocto    =   !is_null($dato['documento'])?$dato['documento']:"";
              $nrofactura   =   $dato['numerofactura'];
              $lapso        =   $dato['lapso'];

              $proveedor        = proveedor::where('nit',$nit)->where('sucursal',$sucursal)->first();
              $proveedoresid    = !is_null($proveedor)?$proveedor->proveedoresID:1;

              $reg_cxp = cuentasporpagar::updateOrCreate(['nit'=>$nit,'sucursal'=>$sucursal,'numerofactura'=>$nrofactura,'tipodedocumento'=>$tipodocto,
              'prefijo'=>$prefijo],
              [
                    'fechafactura'          =>  $dato['fechafactura'],
                    'fechadevencimiento'    =>  $dato['fechavencimiento'],
                    'lapso'                 =>  $lapso,
                    'proyecto'              =>  !is_null($dato['proyecto'])?$dato['proyecto']:"",
                    'sproyecto'             =>  !is_null($dato['sproyecto'])?$dato['sproyecto']:"",
                    'centrooper'            =>  !is_null($dato['centrooper'])?$dato['centrooper']:"",
                    'actividad'             =>  !is_null($dato['actividad'])?$dato['actividad']:"",
                    'cuenta'                =>  !is_null($dato['cuenta'])?$dato['cuenta']:"",
                    'centro'                =>  !is_null($dato['centro'])?$dato['centro']:"",
                    'scentro'               =>  !is_null($dato['scentro'])?$dato['scentro']:"",
                    'tipomvto'              =>  2,
                    'placa'                 =>  !is_null($dato['vehiculo'])?$dato['vehiculo']:"",
                    'propiedad'             =>  !is_null($dato['propiedad'])?$dato['propiedad']:"",
                    'nitarrendatario'       =>  !is_null($dato['nitarrendatario'])?$dato['nitarrendatario']:"",
                    'sucursalarrendatario'  =>  !is_null($dato['sucursalarrendatario'])?$dato['sucursalarrendatario']:"",
                    'fechadepago'           =>  $dato['fechapago'],
                    'numeroegreso'          =>  $dato['egreso'],
                    'dsctopp1'              =>  $dato['dsc1pp'],
                    'dsctopp2'              =>  $dato['dsc2pp'],
                    'dsctopp3'              =>  $dato['dsc3pp'],
                    'dsctopp4'              =>  $dato['dsc4pp'],
                    'dsctopp5'              =>  $dato['dsc5pp'],
                    'dia1pp'                =>  $dato['dia1pp'],
                    'dia2pp'                =>  $dato['dia2pp'],
                    'dia3pp'                =>  $dato['dia3pp'],
                    'dia4pp'                =>  $dato['dia4pp'],
                    'dia5pp'                =>  $dato['dia5pp'],
                    'valordeterioro'        =>  $dato['valordeterioro'],
                    'cufe'                  =>  !is_null($dato['cufe'])?$dato['cufe']:"",
                    'codstatus'             =>  !is_null($dato['codstatus'])?$dato['codstatus']:"",
                    'msgevento1'            =>  !is_null($dato['msgevento1'])?$dato['msgevento1']:"",
                    'msgevento2'            =>  !is_null($dato['msgevento2'])?$dato['msgevento2']:"",
                    'msgevento3'            =>  !is_null($dato['msgevento3'])?$dato['msgevento3']:"",
                    'valorfactura'          =>  $dato['valorfactura'],
                    'estado'                =>  $dato['estado'],
                    'estado01'              =>  $dato['estado01'],
                    'estado02'              =>  $dato['estado02'],
                    'estado03'              =>  $dato['estado03'],
                    'proveedoresid'         =>  $proveedoresid ,
                    'usuario_created'       =>  $dato['usuariocreated'],
                    'usuario_updated'       =>  $dato['usuarioupdated'],
              ]);
        }

        return response()->json(
            [
            'status'       => '200',
            'msg'          => 'Actualización Exitosa 200',
            ],Response::HTTP_ACCEPTED);
       }
    }
}
