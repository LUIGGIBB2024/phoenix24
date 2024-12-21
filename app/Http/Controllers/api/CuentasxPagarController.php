<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\cuentasporpagar;
use App\Models\detalledeotrospago;
use App\Models\detalledepagocxp;
use App\Models\egreso;
use App\Models\proveedor;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;



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
                $nit         =  !is_null($dato['nit'])?$dato['nit']:"";
                $sucursal    =  !is_null($dato['sucursal'])?$dato['sucursal']:"";
                $reg_pagos   =  egreso::updateOrCreate(['consecutivo'=>$consecutivo,'tipodedocumento'=>$tipodocto,'lapso'=>$lapso,'fechadocumento'=>$fechadcto,'nit'=>$nit,'sucursal'=>$sucursal],
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

        if (isset($request->dataotrospagos))
        {
            $otrospagos = $request->dataotrospagos;

            foreach ($otrospagos as $dato)
            {
                $consecutivo    =  $dato['egreso'];
                $tipodocto      =  !is_null($dato['dctoegreso'])?$dato['dctoegreso']:"";
                $concepto       =  !is_null($dato['tipomvto'])?$dato['tipomvto']:"";
                $fecha          =  $dato['fechamvto'];
                $nitter         =  !is_null($dato['nit'])?$dato['nit']:"";
                $lapso          =  $dato['lapso'];
                $cuenta         =  !is_null($dato['cuenta'])?$dato['cuenta']:"";
                $centro         =  !is_null($dato['centro'])?$dato['centro']:"";
                $centrooper     =  !is_null($dato['centrooper'])?$dato['centrooper']:"";

                $dcto_egreso         =  egreso::where('consecutivo',$consecutivo)->where('tipodedocumento',$tipodocto)->where('lapso',$lapso)->where('fechadocumento',$fecha)->first();
                
                return response()->json(
                    [
                    'status'       => '400',
                    'msg'          => 'Actualización Exitosa 200 CXP',
                    'consecutivo'  =>  $consecutivo,  
                    'documento'    =>  $tipodocto, 
                    'fecha'        =>  $fecha,
                    ],Response::HTTP_ACCEPTED);

                $nitegr         =  !is_null($dcto_egreso->nit)?$dcto_egreso->nit:""; 
                $sucursal       =  !is_null($dcto_egreso->sucursal)?$dcto_egreso->sucursal:"";

                


                $reg_otros = detalledeotrospago::updateOrCreate(['consecutivo'=>$consecutivo,'tipodocumento'=>$tipodocto,'centrooper'=>$centrooper,'conceptodepago'=>$concepto,'fechadocumento'=>$fecha,
                             'nittercero'=>$nitter,'sucursaltercero'=>$sucursal,'cuenta'=>$cuenta,'centro'=>$centro],
                [
                    'lapso'                 => $lapso,
                    'nit'                   => $nitegr,
                    'sucursal'              => $sucursal,
                    'scentro'               => "",
                    'tipodemovimiento'      => "0",
                    'placa'                 => !is_null($dato['vehiculo'])?$dato['vehiculo']:"",
                    'valordelpago'          => $dato['valor'],
                    'observaciones'         => !is_null($dato['texto'])?$dato['texto']:"",
                    'numerorecibodecaja'    => $dato['recibo'],
                    'docrecibodecaja'       => "",
                    'nitarrendatario'       => "",
                    'sucursalarrendatario'  => "",
                    'propiedad'             => !is_null($dato['propiedad'])?$dato['propiedad']:"",
                    'proyecto'              => !is_null($dato['proyecto'])?$dato['proyecto']:"",
                    'sproyecto'             => !is_null($dato['sproyecto'])?$dato['sproyecto']:"",
                    'actividad'             => !is_null($dato['actividad'])?$dato['actividad']:"",
                    'estado'                => $dato['estado'],
                    'estado01'              => $dato['estado01'],
                    'estado02'              => $dato['estado02'],
                    'estado03'              => $dato['estado03'],
                    'egresosid'             => $dcto_egreso->egresosID,
                    'usuario_created'       => $dato['usuariocreated'],
                    'usuario_updated'       => $dato['usuarioupdated'],                    
                ]);
            }

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
        }

        if (isset($request->datadtpgcxp))
        {
            $detalle   = $request->datadtpgcxp;
            foreach ($detalle as $dato)
            {
        
                $consecutivo  =   $dato['consecutivo'];
                $fecha        =   $dato['fechadocumento'];
                $doctopago    =   !is_null($dato['tipodocumento'])?$dato['tipodocumento']:""; 
                $nit          =   !is_null($dato['nit'])?$dato['nit']:"";
                $sucursal     =   !is_null($dato['sucursal'])?$dato['sucursal']:"";
                $concepto     =   !is_null($dato['conceptopago'])?$dato['conceptopago']:"";
                $nrofactura   =   $dato['numerofactura'];
                $prefijo      =   !is_null($dato['prefijo'])?$dato['prefijo']:"";
                $tipodocto    =   !is_null($dato['documentofactura'])?$dato['documentofactura']:"";
                $lapso        =   $dato['lapso'];
                $proyecto     =   !is_null($dato['proyecto'])?$dato['proyecto']:"";
                $sproyecto    =   !is_null($dato['sproyecto'])?$dato['sproyecto']:"";
                $centrooper   =   !is_null($dato['centrooper'])?$dato['centrooper']:"";
                $cuenta       =   !is_null($dato['cuenta'])?$dato['cuenta']:"";
                $centro       =   !is_null($dato['centro'])?$dato['centro']:"";
                $scentro      =   !is_null($dato['scentro'])?$dato['scentro']:"";
                $facturas     =   cuentasporpagar::where('numerofactura',$nrofactura)->where('tipodedocumento',$tipodocto)->where('prefijo',$prefijo)
                ->where('nit',$nit)->first();

                //egreso::updateOrCreate(['consecutivo'=>$consecutivo,'tipodedocumento'=>$tipodocto,'lapso'=>$lapso,'fechadocumento'=>$fechadcto]
                $egreso     =   egreso::where('consecutivo',$consecutivo)->where('tipodedocumento',$doctopago)->where('lapso',$lapso)->where('fechadocumento',$fecha)->first();

                $facturaid     = !is_null($facturas)?$facturas->cuentasporpagarID:1;
                $egresoid      = !is_null($egreso)?$egreso->egresosID:1;

                // return response()->json(
                //     [
                //     'status'       => '200',
                //     'msg'          => 'Actualización Exitosa 300',
                //     'factura'      => $facturaid,
                //     'egreso'       => $egresoid,
                //     ],Response::HTTP_ACCEPTED);

                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $reg_pgo = detalledepagocxp::updateOrCreate(['consecutivo'=>$consecutivo,'fechadocumento'=>$fecha,'documentopago'=>$doctopago,'nit'=>$nit,'sucursal'=>$sucursal,
                         'conceptodepago'=>$concepto,'numerodefactura'=>$nrofactura,'documentofactura'=>$tipodocto,'prefijo'=>$prefijo],
                [                          
                    'lapso'                 =>$lapso,
                    'valordelpago'          =>$dato['valorpago'],
                    'cuota'                 =>$dato['cuota'],
                    'proyecto'              =>$proyecto,
                    'sproyecto'             =>$sproyecto,
                    'centrooper'            =>$centrooper,
                    'cuenta'                =>$cuenta,
                    'centro'                =>$centro,
                    'scentro'               =>$scentro,     
                    'actividad'             =>!is_null($dato['actividad'])?$dato['actividad']:"",               
                    'facturacxpid'          =>$facturaid,
                    'egresosid'             =>$egresoid,       
                    'estado'                =>$dato['estado'], 
                    'estado01'              =>0, 
                    'estado02'              =>0, 
                    'estado03'              =>0, 
                    'usuario_created'       =>$dato['usuariocreated'],
                    'usuario_updated'       =>$dato['usuarioupdated'],
                ]);
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            }
        }

        return response()->json(
            [
            'status'       => '200',
            'msg'          => 'Actualización Exitosa 200 CXP',
            ],Response::HTTP_ACCEPTED);
    }
}

