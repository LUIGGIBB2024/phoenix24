<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\cartera;
use App\Models\cliente;
use App\Models\detalledepago;
use App\Models\factura;
use App\Models\otrospagosventa;
use App\Models\recibosdecaja;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CarteraController extends Controller
{
    public function ProcessCxc(Request $request):JsonResponse
    {
        $Si_Entro = false;       
        if (isset($request->dataotrospagos))
        {
            $otrospagos   = $request->dataotrospagos;
            $contador = 0;
            foreach ($otrospagos as $dato)
            {
              $consecutivo   =  $dato['consecutivopago'];
              $tipodocto    =   !is_null($dato['tipodocumento'])?$dato['tipodocumento']:"";
              $fecha        =   $dato['fechadocumento'];
              $concepto     =   !is_null($dato['concepto'])?$dato['concepto']:"";
              $proyecto     =   !is_null($dato['proyecto'])?$dato['proyecto']:"";
              $sproyecto    =   "";
              $centrooper   =   !is_null($dato['centrooper'])?$dato['centrooper']:"";
              $banco        =   !is_null($dato['banco'])?$dato['banco']:"";
              $idlocal      =   $dato['idregistro'];
              DB::statement('SET FOREIGN_KEY_CHECKS=0;');
              $reg_pago = otrospagosventa::updateOrCreate(['consecutivo'=>$consecutivo,'tipodocumento'=>$tipodocto,'fechadocumento'=>$fecha,
                                                           'concepto'=>$concepto,'banco'=>$banco,'idlocal'=>$idlocal],                                                 
              [
                'nrodocumento'      =>!is_null($dato['nrodocumento'])?$dato['nrodocumento']:"",
                'lapso'             =>$dato['lapso'],                
                'fechadecheque'     => $dato['fechacheque'],
                'plaza'             =>!is_null($dato['plaza'])?$dato['plaza']:"",
                'valor'             =>$dato['valor'],
                'proyecto'          =>$proyecto,
                'sproyecto'         =>$sproyecto,
                'centrooper'        =>$centrooper,
                'actividad'         =>"",
                'usuario_created'  => is_null($dato['usuariocreated'])?"":$dato['usuariocreated'],
                'usuario_updated'  => is_null($dato['usuarioupdated'])?"":$dato['usuarioupdated'],
              ]);

              $Si_Entro = true;
              DB::statement('SET FOREIGN_KEY_CHECKS=1;');

           }
           return response()->json(
                [
                'status'       => '200',
                'msg'          => 'Actualización Exitosa (otros Pagos) 200',
                ],Response::HTTP_ACCEPTED); 
       }


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
              $scentro      =   !is_null($dato['scentro'])?$dato['scentro']:"";

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
                'usuario_created'  => is_null($dato['usuariocreated'])?"":$dato['usuariocreated'],
                'usuario_updated'  => is_null($dato['usuarioupdated'])?"":$dato['usuarioupdated'],
              ]);
              $Si_Entro = true;

           }
            return response()->json(
                 [
                 'status'       => '200',
                 'msg'          => 'Actualización Exitosa - Pagos',
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
                'tipodocumento'         =>$tipodocto,
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
                'usuario_created'       => is_null($dato['usuariocreated'])?"":$dato['usuariocreated'],
                'usuario_updated'       => is_null($dato['usuarioupdated'])?"":$dato['usuarioupdated'],
              ]);
              DB::statement('SET FOREIGN_KEY_CHECKS=1;');
              $Si_Entro = true;

           }

            return response()->json(
                    [
                    'status'       => '200',
                    'msg'          => 'Actualización Exitosa - Cartera/Detalle de Pagos',
                    ],Response::HTTP_ACCEPTED);      
       }

       if (isset($request->datapagoscxc))
        {
            $pagos       = $request->datapagoscxc;
            $contador = 0;
            foreach ($pagos as $dato)
            {
              $nit              =   !is_null($dato['nit'])?$dato['nit']:"";
              $sucursal         =   !is_null($dato['sucursal'])?$dato['sucursal']:"";
              $consecutivo      =   $dato['consecutivo'];  
              $documento        =   !is_null($dato['documento'])?$dato['documento']:"";
              $fecha            =   $dato['fechadocumento'];
              $lapso            =   $dato['lapso'];
              $documento        =   !is_null($dato['documento'])?$dato['documento']:"";
              $actividad        =   !is_null($dato['actividad'])?$dato['actividad']:"";
              $centrooper       =   !is_null($dato['centrooper'])?$dato['centrooper']:"";
              $proyecto         =   "";
              $sproyecto        =   "";
              $cuenta           =   "";
              $centro           =   "";
              $scentro          =   "";
              $pagoenefectivo   =   $dato['pagoenefectivo']; 
              $pagoencheques    =   $dato['pagoencheques']; 
              $pagootros	      =   $dato['pagootros']; 
              $observaciones    =   trim($dato['observaciones1']) . " " .  trim($dato['observaciones2']); 
              $tipopago	        =   $dato['tipopago']; 
              $estado	          =   $dato['estado']; 
              $tiporecibo	      =   $dato['tiporecibo']; 
              $tipomvto         =   0; 
              $cptointerface    =   !is_null($dato['cptointerface'])?$dato['cptointerface']:"";
              $vendedor         =   !is_null($dato['vendedor'])?$dato['vendedor']:"";
              $saldoactual	    =   $dato['saldoactual'];

              // $facturas     = factura::where('numerodefactura',$nrofactura)->where('prefijo',$prefijo)
              //                        ->where('tipodedocumento',$tipodocto)->where('fechafactura',$fecha)->first();

              $clientes         = cliente::where('nit',$nit)->where('sucursal',$sucursal)->first();
              $vendedor         = !empty($clientes->vendedor)?$clientes->vendedor:"";

              $contador++;
              // $facturaid     = !is_null($facturas)?$facturas->FacturasID:1;
              // $clienteid     = !is_null($clientes)?$clientes->clientesID:1;
       
              if ($consecutivo>0)
              {
                $reg_pago = recibosdecaja::updateOrCreate(['nit'=>$nit,'sucursal'=>$sucursal,'consecutivo'=>$consecutivo,'tipodocumento'=>$documento,
                                                    'fechadocumento'=>$fecha],
                [
                  'lapso'             =>$lapso,
                  'valorefectivo'     =>$pagoenefectivo,
                  'valorotro'         =>$pagoencheques,
                  'observaciones'     =>$observaciones,
                  'tipodepago'        =>$tipopago,
                  'tipoderecibo'      =>$tiporecibo,
                  'saldoactual'       =>$saldoactual,
                  'proyecto'          =>$proyecto,
                  'sproyecto'         =>"",
                  'centrooper'        =>$centrooper,
                  'actividad'         =>$centrooper,
                  'cuenta'            =>$cuenta,
                  'centro'            =>$centro,
                  'scentro'           =>$scentro,
                  'tipodemovimiento'  =>0,
                  'vendedor'          =>$vendedor,
                  'estado'            =>$estado,
                  'estado1'           =>0,
                  'estado2'           =>0,
                  'estado3'           =>0,
                  'usuario_created'  => is_null($dato['usuariocreated'])?"":$dato['usuariocreated'],
                  'usuario_updated'  => is_null($dato['usuarioupdated'])?"":$dato['usuarioupdated'],
                ]);
              }
              if ($estado == 2)
                 {
                  DB::table('detalledepagoscxc')->where(['nit'=>$nit,'sucursal'=>$sucursal,'consecutivo'=>$consecutivo,'documentopago'=>$documento,
                  'fechadocumento'=>$fecha])->delete();
                 }
           }
            return response()->json(
                 [
                 'status'       => '200',
                 'msg'          => 'Actualización Exitosa - Pagos',
                 ],Response::HTTP_ACCEPTED);
       }
       return response()->json(
                 [
                 'status'       => '200',
                 'msg'          => 'Actualización Exitosa - Pagos',
                 ],Response::HTTP_ACCEPTED);

    }

    public function CarteraResumida(Request $request):JsonResponse
    {

        $fechacorte = $request->fechacorte;
        $name       = $request->nombre;
        $vendedor   = $request->vendedor;
        $desdevendedor  = "";
        $hastavendedor  = "zzzzzzzzzz";
        if (!is_null($vendedor))
           {
              $desdevendedor  = $vendedor;
              $hastavendedor  = $vendedor;
           }
           

          //  return response()->json(
          //   [
          //   'status'          => '200 ok2',
          //   'msg'             => 'Consulta de Cartera Existosa',
          //   'desdevendedor'    => $desdevendedor,
          //   'hastavendedor'    => $hastavendedor,
          //   ],Response::HTTP_ACCEPTED);
        $pagos = detalledepago::select('nit', 'sucursal')
                ->selectRaw('sum(detalledepagoscxc.valor) as abonos')
                ->where('detalledepagoscxc.fechadocumento','<=',$fechacorte)
                ->groupBy(['detalledepagoscxc.nit', 'detalledepagoscxc.sucursal']);

          $cartera = cartera::selectRaw("clientes.nombrecompleto, SUM(cuentasporcobrar.valorfactura) as total, dpagos.abonos,  SUM(cuentasporcobrar.valorfactura) - IFNULL(dpagos.abonos,0) as misaldo")
          ->selectRaw("cuentasporcobrar.nit,cuentasporcobrar.sucursal,cuentasporcobrar.cuentasporcobrarid")
          ->selectRaw("0.00 as saldo")
          ->join("clientes",function($join)
                {
                  $join->on("clientes.nit","=","cuentasporcobrar.nit")
                       ->on("clientes.sucursal","=","cuentasporcobrar.sucursal");
                })
          ->leftjoinSub($pagos,'dpagos',function($join)
                {
                    $join->on('cuentasporcobrar.nit','=','dpagos.nit')
                         ->on('cuentasporcobrar.sucursal','=','dpagos.sucursal');
                })
           ->where('cuentasporcobrar.fechafactura','<=',$fechacorte)
           ->where('cuentasporcobrar.estado','=',1)
           ->where('clientes.nombrecompleto', 'like', '%' . $name . '%')
           ->where('cuentasporcobrar.vendedor', '>=' , $desdevendedor)
           ->where('cuentasporcobrar.vendedor', '<=' , $hastavendedor)
           ->groupBy('clientes.nombrecompleto','cuentasporcobrar.nit','cuentasporcobrar.sucursal')
           ->havingRaw('cast(misaldo as int) > 0')          
           ->get();

           $totalcartera = 0;
           $totregistros = 0;
           
           foreach ($cartera as $dato)
           {
              $dato->abonos =  is_null($dato->abonos)?"0":$dato->abonos;
              $saldo         =  (int)  $dato->total - (int) $dato->abonos;
              $dato->total   =  (int) $dato->total;
              $dato->abonos  =  (int) $dato->abonos;
              $dato->saldo   =  (int) $saldo;
              $totalcartera  += (int) $saldo;
              $totregistros += 1;
           }

         return response()->json(
                  [
                  'status'          => '200 ok1',
                  'msg'             => 'Consulta de Cartera Existosa',
                  'totalcartera'    => $totalcartera,
                  'totalregistros'  => $totregistros,
                  'detalles'        => $cartera,
                  ],Response::HTTP_ACCEPTED);
    }


    public function CarteraDetallada(Request $request):JsonResponse
    {
        $fechacorte = $request->fechacorte;
        $nit        = $request->nit;
        $sucursal   = $request->sucursal;
        $vendedor   = $request->vendedor;
        $desdevendedor  = "";
        $hastavendedor  = "zzzzzzzzzz";
        if (!is_null($vendedor))
           {
              $desdevendedor  = $vendedor;
              $hastavendedor  = $vendedor;
           }
           
        $pagos = detalledepago::select('nit', 'sucursal','numerodefactura','prefijo','tipodocumento','facturacxcid')
                ->selectRaw('sum(detalledepagoscxc.valor) as abonos')
                ->where('detalledepagoscxc.fechadocumento','<=',$fechacorte)
                ->where('detalledepagoscxc.nit','=',$nit)
                ->where('detalledepagoscxc.sucursal','=',$sucursal)
                ->groupBy(['facturacxcid']);

        $cartera = cartera::selectRaw("clientes.nombrecompleto, cuentasporcobrar.fechafactura, cuentasporcobrar.fechadevencimiento")
                ->selectRaw("cuentasporcobrar.numerodefactura,cuentasporcobrar.prefijo,cuentasporcobrar.tipodedocumento")
                ->selectRaw("cuentasporcobrar.nit,cuentasporcobrar.sucursal,cuentasporcobrar.cuentasporcobrarid")
                ->selectRaw("DATEDIFF('$fechacorte', cuentasporcobrar.fechadevencimiento) + 1 as Dias")
                //->selectRaw("cuentasporcobrar.fechadevencimiento->diff($fechacorte) as Dias")
                ->selectRaw('cuentasporcobrar.cuentasporcobrarid')
                ->selectRaw("cuentasporcobrar.valorfactura as total, pagos.abonos as abonos")
                ->selectRaw("0.00 as saldo")
                ->join("clientes",function($join)
                      {
                        $join->on("clientes.nit","=","cuentasporcobrar.nit")
                              ->on("clientes.sucursal","=","cuentasporcobrar.sucursal");
                      })
                  ->leftjoinSub($pagos,'pagos',function($join)
                      {
                          $join->on('cuentasporcobrar.cuentasporcobrarid','=','pagos.facturacxcid')
                               ->on('cuentasporcobrar.nit','=','pagos.nit')
                               ->on('cuentasporcobrar.tipodedocumento','=','pagos.tipodocumento');
                      })
                ->where('cuentasporcobrar.fechafactura','<=',$fechacorte)
                ->where('cuentasporcobrar.nit','=',$nit)
                ->where('cuentasporcobrar.estado','=',1)
                ->where('cuentasporcobrar.sucursal','=',$sucursal)
                ->where('cuentasporcobrar.vendedor', '>=' , $desdevendedor)
                ->where('cuentasporcobrar.vendedor', '<=' , $hastavendedor)
                ->groupBy('cuentasporcobrar.cuentasporcobrarid')
                ->orderBy('clientes.nombrecompleto')
                ->havingRaw('total <> abonos')
                ->orhavingRaw('abonos is NULL')
                ->get();


           $totalcartera = 0;
           $totregistros = 0;
           foreach ($cartera as $dato)
           {
              $dato->abonos =  is_null($dato->abonos)?"0.00":$dato->abonos;
              $saldo         = (float) $dato->total - (float)  $dato->abonos;
              $dato->total   = (float) $dato->total;
              $dato->abonos  = (float) $dato->abonos;
              $dato->saldo   = $saldo;
              $totalcartera  += $saldo;
              $totregistros += 1;
           }

         return response()->json(
                  [
                  'status'          => '200',
                  'msg'             => 'Consulta de Cartera Existosa',
                  'totalcartera'    => $totalcartera,
                  'totalregistros'  => $totregistros,
                  'facturas'      => $cartera,
                  ],Response::HTTP_ACCEPTED);

    }
    
}
