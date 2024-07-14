<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\cartera;
use App\Models\cliente;
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
            $contador = 0;
            foreach ($cartera as $dato)
            {
              $nit          =   !is_null($dato['nit'])?$dato['nit']:"";
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

              $clientes     = cliente::where('nit',$nit)->where('sucursal',$sucursal)->first();


              $contador++;
              $facturaid     = !is_null($facturas)?$facturas->FacturasID:1;
              $clienteid     = !is_null($clientes)?$clientes->clientesID:1;

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
                'facturaid'         =>$facturaid,
                'clientesid'        =>$clienteid,
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
                                      ->where('nit',$nit)->first();

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
                'facturacxcid'          =>$facturaid,
                'recibodecajaid'        =>1,
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

    public function CarteraResumida(Request $request):JsonResponse
    {

        $fechacorte = $request->fechacorte;

        $pagos = detalledepago::select('nit', 'sucursal')
                ->selectRaw('sum(detalledepagoscxc.valor) as abonos')
                ->where('detalledepagoscxc.fechadocumento','<=',$fechacorte)
                ->groupBy(['detalledepagoscxc.nit', 'detalledepagoscxc.sucursal']);

          $cartera = cartera::selectRaw("clientes.nombrecompleto, SUM(cuentasporcobrar.valorfactura) as total, dpagos.abonos")
            ->selectRaw("0.00 as saldo")
            ->join("clientes",function($join)
                {
                  $join->on("clientes.nit","=","cuentasporcobrar.nit")
                        ->on("clientes.sucursal","=","cuentasporcobrar.sucursal");
                })
             ->joinSub($pagos,'dpagos',function($join)
                {
                    $join->on('cuentasporcobrar.nit','=','dpagos.nit')
                          ->on('cuentasporcobrar.sucursal','=','dpagos.sucursal');
                })
           ->where('cuentasporcobrar.fechafactura','<=',$fechacorte)
           ->groupBy('clientes.nombrecompleto')
           ->havingRaw('total <> abonos')
           ->get();

           $totalcartera = 0;
           foreach ($cartera as $dato)
           {
              $dato->abonos =  is_null($dato->abonos)?"0.00":$dato->abonos;
              $saldo         = (float) $dato->total - (float)  $dato->abonos;
              $dato->total   = (float) $dato->total;
              $dato->abonos  = (float) $dato->abonos;
              $dato->saldo   = $saldo;
              $totalcartera  += $saldo;
           }

         return response()->json(
                  [
                  'status'        => '200',
                  'msg'           => 'Consulta de Cartera Existosa',
                  'totalcartera'  => $totalcartera,
                  'detalle'       => $cartera,
                  ],Response::HTTP_ACCEPTED);

    }

    public function CarteraDetallada(Request $request):JsonResponse
    {

        $fechacorte = $request->fechacorte;

        $pagos = detalledepago::select('nit', 'sucursal','numerodefactura','prefijo','tipodedocumento')
                ->selectRaw('sum(detalledepagoscxc.valor) as abonos')
                ->where('detalledepagoscxc.fechadocumento','<=',$fechacorte)
                ->groupBy(['detalledepagoscxc.nit', 'detalledepagoscxc.sucursal','detalledepagoscxc.numerodefactura','detalledepagoscxc.prefijo','detalledepagoscxc.tipodedocumento'])
                ->get();

                return response()->json(
                    [
                    'status'        => '200',
                    'msg'           => 'Consulta de Cartera Existosa',
                    'totalcartera'  => $pagos,
                    ],Response::HTTP_ACCEPTED);

          $cartera = cartera::selectRaw("clientes.nombrecompleto, SUM(cuentasporcobrar.valorfactura) as total, dpagos.abonos")
            ->selectRaw("0.00 as saldo")
            ->join("clientes",function($join)
                {
                  $join->on("clientes.nit","=","cuentasporcobrar.nit")
                        ->on("clientes.sucursal","=","cuentasporcobrar.sucursal");
                })
             ->joinSub($pagos,'dpagos',function($join)
                {
                    $join->on('cuentasporcobrar.nit','=','dpagos.nit')
                          ->on('cuentasporcobrar.sucursal','=','dpagos.sucursal');
                })
           ->where('cuentasporcobrar.fechafactura','<=',$fechacorte)
           ->groupBy('clientes.nombrecompleto')
           ->havingRaw('total <> abonos')
           ->get();

           $totalcartera = 0;
           foreach ($cartera as $dato)
           {
              $dato->abonos =  is_null($dato->abonos)?"0.00":$dato->abonos;
              $saldo         = (float) $dato->total - (float)  $dato->abonos;
              $dato->total   = (float) $dato->total;
              $dato->abonos  = (float) $dato->abonos;
              $dato->saldo   = $saldo;
              $totalcartera  += $saldo;
           }

         return response()->json(
                  [
                  'status'        => '200',
                  'msg'           => 'Consulta de Cartera Existosa',
                  'totalcartera'  => $totalcartera,
                  'detalle'       => $cartera,
                  ],Response::HTTP_ACCEPTED);

    }
}
