<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\cartera;
use App\Models\detalledepago;
use App\Models\factura;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CarteraController extends Controller
{
    public function ProcessCxc(Request $request):JsonResponse
    {
        if (isset($request->datacxc))
        {
            $cartera   = $request->datacxc;
            foreach ($cartera as $dato)
            {
              $nit          =   $dato['nit'];
              $sucursal     =   !is_null($dato['sucursal'])?$dato['sucursal']:"";
              $nrofactura   =   $dato['numerofactura'];
              $prefijo      =   !is_null($dato['prefijo'])?$dato['prefijo']:"";
              $tipodocto    =   !is_null($dato['tipodocumento'])?$dato['tipodocumento']:"";
              $fecha        =   $dato['fechafactura'];
              $lapso        =   $dato['lapso'];
              $propiedad    =   !is_null($dato['propiedad'])?$dato['propiedad']:"";
              $vendedor     =   !is_null($dato['vendedor'])?$dato['vendedor']:"";
              $proyecto     =   !is_null($dato['proyecto'])?$dato['proyecto']:"";
              $sproyecto    =   !is_null($dato['sproyecto'])?$dato['sproyecto']:"";
              $centrooper   =   !is_null($dato['centrooper'])?$dato['centrooper']:"";
              $cuenta       =   !is_null($dato['cuenta'])?$dato['cuenta']:"";
              $centro       =   !is_null($dato['centro'])?$dato['centro']:"";
              $scentro      =   !is_null($dato['centro'])?$dato['scentro']:"";

              $facturas     = factura::where('numerodefactura',$nrofactura)->where('prefijo',$prefijo)
                                     ->where('tipodedocumento',$tipodocto)->where('fechafactura',$fecha)->first();

              $facturaid     = is_object($facturas)?$facturas->FacturasID:1;
              $clienteid     = is_object($facturas)?$facturas->ClientesID:1;

              $reg_cxc = cartera::updateOrCreate(['nit'=>$nit,'sucursal'=>$sucursal,'numerodefactura'=>$nrofactura,'tipodedocumento'=>$tipodocto,
                                                  'prefijo'=>$prefijo,'fechafactura'=>$fecha],
              [
                'fechadevencimiento'=>$dato['fechavencimiento'],
                'lapso'             =>$lapso,
                'valorfactura'      =>$dato['valorfactura'],
                'valorintereses'    =>$dato['valorintereses'],
                'valorseguro'       =>$dato['valorseguro'],
                'valorcuota'        =>$dato['valorcuota'],
                'valordeterioro'    =>$dato['valordeterioro'],
                'numerodecuota'     =>$dato['nrodecuotas'],
                'tipodeprestamo'    =>$dato['tipodeprestamo'],
                'porcentaje'        =>$dato['porcentaje'],
                'tipodemovimiento'  =>$dato['tipomvto'],
                'tipod'             =>$dato['tipod'],
                'dia1'              =>$dato['dia1'],
                'dia2'              =>$dato['dia2'],
                'propiedad'         =>$propiedad,
                'vendedor'          =>$vendedor,
                'rutadeventa'       =>"",
                'zonadeventa'       =>"",
                'proyecto'          =>$proyecto,
                'sproyecto'         =>$sproyecto,
                'centrooper'        =>$centrooper,
                'cuenta'            =>$cuenta,
                'centro'            =>$centro,
                'scentro'           =>$scentro,
                'estado'            =>$dato['estado'],
                'facturaID'         =>$facturaid,
                'ClientesID'        =>$clienteid,
                'usuario_created'   =>$dato['usuariocreated'],
                'usuario_updated'   =>$dato['usuarioupdated'],
              ]);

           }
            return response()->json(
                [
                'status'       => '200',
                'msg'          => 'Actualización Exitosa',
                ],Response::HTTP_ACCEPTED);
       }

       if (isset($request->datadtpgcxc))
        {
            $detalle   = $request->datadtpgcxc;
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
              $tipodocto    =   !is_null($dato['docfactura'])?$dato['docfactura']:"";
              $lapso        =   $dato['lapso'];
              $proyecto     =   !is_null($dato['proyecto'])?$dato['proyecto']:"";
              $sproyecto    =   !is_null($dato['sproyecto'])?$dato['sproyecto']:"";
              $centrooper   =   !is_null($dato['centrooper'])?$dato['centrooper']:"";
              $cuenta       =   !is_null($dato['cuenta'])?$dato['cuenta']:"";
              $centro       =   !is_null($dato['centro'])?$dato['centro']:"";
              $scentro      =   !is_null($dato['scentro'])?$dato['sscentro']:"";
              $actividad    =   !is_null($dato['actividad'])?$dato['actividad']:"";
              $facturas     =   cartera::where('numerodefactura',$nrofactura)->where('tipodedocumento',$tipodocto)->where('prefijo',$prefijo)
                                      ->where('nit',$nit)->where('fechafactura','=',$fecha)->first();

                                      return response()->json(
                                        [
                                        'status'       => '200',
                                        'msg'          => 'Actualización Exitosa ffff',
                                        'cxc'          => $facturas,
                                        ],Response::HTTP_ACCEPTED);
              $facturaid     = !is_null($facturas)?$facturas->cuentasporcobrarID:1;
              //$clienteid     = is_object($facturas)?$facturas->ClienteID:1;
              DB::statement('SET FOREIGN_KEY_CHECKS=0;');
              $reg_pgo = detalledepago::updateOrCreate(['consecutivo'=>$consecutivo,'fechadocumento'=>$fecha,'documentopago'=>$doctopago,'nit'=>$nit,'sucursal'=>$sucursal,
                         'concepto'=>$concepto,'numerodefactura'=>$nrofactura,'tipodocumento'=>$tipodocto,'prefijo'=>$prefijo],
              [
                'actividad'             =>$actividad,
                'lapso'                 =>$lapso,
                'valor'                 =>$dato['valorpago'],
                'cuota'                 =>$dato['cuota'],
                'saldofactura'          =>$dato['saldofactura'],
                'fechapagodeservicios'  =>$dato['fechapagodeservicios'],
                'proyecto'              =>$proyecto,
                'sproyecto'             =>$sproyecto,
                'centrooper'            =>$centrooper,
                'cuenta'                =>$cuenta,
                'centro'                =>$centro,
                'scentro'               =>$scentro,
                'facturacxcID'          =>$facturaid,
                'recibodecajaID'        =>1,
                'notacreditoID'         =>1,
                'usuario_created'       =>$dato['usuariocreated'],
                'usuario_updated'       =>$dato['usuarioupdated'],
              ]);
              DB::statement('SET FOREIGN_KEY_CHECKS=1;');

           }
            return response()->json(
                [
                'status'       => '200',
                'msg'          => 'Actualización Exitosa',
                ],Response::HTTP_ACCEPTED);
       }

    }

}