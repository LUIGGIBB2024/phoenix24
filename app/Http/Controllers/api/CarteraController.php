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

        $pagos = DB::table('detalledepagoscxc')->select('nit', 'sucursal')
                ->selectRaw('sum(detalledepagoscxc.valor) as abonos')
                ->groupBy(['detalledepagoscxc.nit', 'detalledepagoscxc.sucursal'])
                ->get();

          return response()->json(
                  [
                  'status'        => '200',
                  'msg'           => 'Actualización Cartea 2024',
                  'pagos'       => $pagos,
                  ],Response::HTTP_ACCEPTED);

          $cartera = cartera::selectRaw("clientes.nombrecompleto, SUM(cuentasporcobrar.valorfactura) as total")
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
           //->leftjoin('detalledepagoscxc','detalledepagoscxc.facturacxcID','=','cuentasporcobrar.cuentasporcobrarID')
           ->where('cuentasporcobrar.fechafactura','<=',$fechacorte)
           ->groupBy('clientes.nombrecompleto')
           ->havingRaw('total <> abono')
           ->get();

         return response()->json(
                  [
                  'status'        => '200',
                  'msg'           => 'Actualización Cartea 2024',
                  'pagos'       => $pagos,
                  ],Response::HTTP_ACCEPTED);

        $cartera = DB::table('cuentasporcobrar')->select('cuentasporcobrar.nit, cuentasporcobrar.sucursal')
                ->select('cuentasporcobrar.valor as totalfacturas')
                ->joinSub($pagos,'dpagos',function($join)
                  {
                      $join->on('cuentasporcobrar.nit','=','dpagos.nit')
                           ->on('cuentasporcobrar.sucursal','=','dpagos.sucursal');
                  })
                // ->leftjoin("clientes",function($join)
                //     {
                //       $join->on("clientes.nit","=","cuentasporcobrar.nit")
                //            ->on("clientes.sucursal","=","cuentasporcobrar.sucursal");
                //     })
                ->groupBy(['cuentasporcobrar.nit','cuentasporcobrar.sucursal'])
                ->where('cuentasporcobrar.fechafactura','<=',$fechacorte)
                //->orderBy('clientes.nombrecompleto')
                //->havingRaw('totalfacturas <> abonos')
                ->get();


             $totalcartera = 0;
             //foreach ($cartera as $dato)
             //{
             //   $dato->abonos =  is_null($dato->abonos)?"0.00":$dato->abonos;
             //   $saldo  =  (float) $dato->totalfacturas - (float)  $dato->abonos;
             //   $dato->totalfacturas = (float) $dato->totalfacturas;
             //   $dato->abonos = (float) $dato->abonos;
             //   $dato->saldo = $saldo;
             //   $totalcartera += $saldo;
             //}

        return response()->json(
              [
              'status'        => '200',
              'msg'           => 'Actualización Cartea 2024',
              //'totalcartera'  => $totalcartera,
              'detalle'       => $cartera,
             ],Response::HTTP_ACCEPTED);

        $pagos      = detalledepago::selectRaw(['detalledepagoscxc.nit','detalledepagoscxc.sucursal'])
                      ->groupBy('nit','sucursal')
                      ->sum('detalledepagoscxc.valor')
                      ->where('detalledepagoscxc.fechadocumento','<=',$fechacorte);


                      //->where('detalledepagoscxc.fechadocumento','<=',$fechacorte)
                     // ->groupBy('detalledepagoscxc.nit');

                      return response()->json(
                        [
                        'status'        => '200',
                        'msg'           => 'Actualización Exitosa Pagos 222',
                        'pagos'         => $pagos,
                       ],Response::HTTP_ACCEPTED);


        $cartera = cartera::selectRaw("clientes.nombrecompleto, SUM(cuentasporcobrar.valorfactura) as total")
                 ->selectRaw('sum(detalledepagoscxc.valor) as abono, 0.00 as saldo')
                 ->join("clientes",function($join)
                    {
                      $join->on("clientes.nit","=","cuentasporcobrar.nit")
                           ->on("clientes.sucursal","=","cuentasporcobrar.sucursal");
                    })
                  ->leftjoin('detalledepagoscxc','detalledepagoscxc.facturacxcID','=','cuentasporcobrar.cuentasporcobrarID')
                  ->where('cuentasporcobrar.fechafactura','<=',$fechacorte)
                  ->groupBy('clientes.nombrecompleto')
                  ->havingRaw('total <> abono')
                  ->get();

        $totalcartera = 0;
        foreach ($cartera as $dato)
        {
           $dato->abono =  is_null($dato->abono)?"0.00":$dato->abono;
           $saldo  =  (float) $dato->total - (float)  $dato->abono;
           $dato->total = (float) $dato->total;
           $dato->abono = (float) $dato->abono;
           $dato->saldo = $saldo;
           $totalcartera += $saldo;
        }

        return response()->json(
            [
            'status'        => '200',
            'msg'           => 'Actualización Exitosa Cartera',
            'totalcartera'  => $totalcartera,
            'detalle'       => $cartera,
            ],Response::HTTP_ACCEPTED);

    }

    public function CarteraResumida1(Request $request):JsonResponse
    {
        $fechacorte = $request->fechacorte;
        $cartera = cartera::selectRaw("clientes.nombrecompleto, SUM(cuentasporcobrar.valorfactura) as total")
                   ->selectRaw('sum(detalledepagoscxc.valor) as abono, 0.00 as saldo')
                   ->join("clientes",function($join)
                    {
                      $join->on("clientes.nit","=","cuentasporcobrar.nit")
                           ->on("clientes.sucursal","=","cuentasporcobrar.sucursal");
                    })
                  ->leftjoin('detalledepagoscxc','detalledepagoscxc.facturacxcid','=','cuentasporcobrar.cuentasporcobrarid')
                  ->where('cuentasporcobrar.fechafactura','<=',$fechacorte)
                  ->groupBy('clientes.nombrecompleto')
                  ->havingRaw('total <> abono')
                  ->get();

        $totalcartera = 0;
        foreach ($cartera as $dato)
        {
           $dato->abono =  is_null($dato->abono)?"0.00":$dato->abono;
           $saldo  =  (float) $dato->total - (float)  $dato->abono;
           $dato->total = (float) $dato->total;
           $dato->abono = (float) $dato->abono;
           $dato->saldo = $saldo;
           $totalcartera += $saldo;
        }

        return response()->json(
            [
            'status'        => '200',
            'msg'           => 'Actualización Exitosa Cartera',
            'totalcartera'  => $totalcartera,
            'detalle'       => $cartera,
            ],Response::HTTP_ACCEPTED);

    }

}
