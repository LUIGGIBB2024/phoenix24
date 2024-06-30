<?php

namespace App\Http\Controllers;

use App\Models\contenido;
use App\Models\enlacevisual_nv;
use App\Models\factura;
use App\Models\Pedido;
use App\Models\remision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
   public function index()
   {


      set_time_limit(60);
      $contenidos = contenido::orderBy('idcontenido')->get();
      return view ('home.homeinicio',compact('contenidos'));
   }

   public function acercade()
   {
      $contenidos = contenido::orderBy('idcontenido')->get();
      return view ('acercade.acercade',compact('contenidos'));
   }

   public function mision()
   {
      $contenidos = contenido::orderBy('idcontenido')->get();
      return view ('acercade.misionvision',compact('contenidos'));
   }

   public function index_app()
   {
        $empresa = enlacevisual_nv::find(1);
        $anoproceso = trim($empresa->anofacturacion);
        $ano1    = trim($empresa->anofacturacion)."01";
        $ano2    = trim($empresa->anofacturacion)."12";
        $ventasrem = remision::where('estado', 1)->whereBetween('lapso', [$ano1,$ano2])->sum('totaldocumento');
        $ventas    = factura::where('estado', 1)->whereBetween('lapso', [$ano1,$ano2])->sum('totalfactura');
        $totalventas = $ventas + $ventasrem;
        $totalpedidos    = Pedido::where('estado', 1)->whereBetween('lapso', [$ano1,$ano2])->sum('totalpedido');

        // Procesar Cartera
        $dia1 = -99999999;
        $dia2 =  99999999;
        $s_InfoCartera =
        "SELECT 1 Proceso, a.ClientesID as id, c.nombrecompleto, d.nombre as vendedor, e.descripcion as nombredelaciudad, NVL(SUM(a.valorfactura),0) totalfacturas,
            NVL(SUM(pgo0.Abonos),0) totalabonos, (NVL(SUM(a.valorfactura),0)-NVL(SUM(pgo0.Abonos),0)) saldo, 000.00 Porcentaje,1 AS IdEdad, a.nit, a.sucursal, a.cuentasporcobrarID  FROM cuentasporcobrar a
         LEFT  JOIN (SELECT 1 tipoc, SUM(b.valor) Abonos, b.concepto, b.facturacxcID FROM detalledepagoscxc b GROUP BY b.facturacxcID) pgo0 ON a.cuentasporcobrarID = pgo0.facturacxcID
         left join  clientes             c on a.nit = c.nit and a.sucursal=c.sucursal
         left join  vendedor             d on a.vendedor = d.codigo
         left join  detallemiscelaneos   e on c.ciudad = e.codigo
         WHERE
            DATEDIFF(CURDATE(),a.fechadevencimiento)>=$dia1 AND DATEDIFF(CURDATE(),a.fechadevencimiento)<=$dia2 AND a.estado = 1 AND e.codigoID='117'
         GROUP BY
            Proceso
         HAVING
             saldo > 0 or saldo < 0";

        $totcartera = DB::select($s_InfoCartera);

        $totalcartera = empty($totcartera[0]->saldo)?0:(float) $totcartera[0]->saldo;

        // Procesar Cuentas x Pagar
        $dia1 = -99999999;
        $dia2 =  99999999;
        $s_InfoCxp =
        "SELECT
            1 Proceso,  c.proveedoresID  as id, c.nombrecompleto, a.nit, e.descripcion nombredelaciudad, NVL(SUM(a.valorfactura),0) totalfacturas, NVL(SUM(pgo0.Abonos),0) totalabonos,
                 (NVL(SUM(a.valorfactura),0)-NVL(SUM(pgo0.Abonos),0)) saldo, 000.00 Porcentaje,1 AS IdEdad, a.sucursal
        FROM
            cuentasporpagar a
        LEFT  JOIN 	(SELECT 1 tipoc,SUM(b.valordelpago) Abonos,b.conceptodepago concepto, b.facturacxpID FROM detalledepagoscxp b
                     GROUP BY b.facturacxpID) pgo0 ON a.cuentasporpagarID = pgo0.facturacxpID
        left join  proveedores          c on a.nit = c.nit and a.sucursal=c.sucursal
        left join  detallemiscelaneos   e on c.ciudad = e.codigo
        WHERE
             DATEDIFF(CURDATE(),a.fechadevencimiento)>=$dia1 AND DATEDIFF(CURDATE(),a.fechadevencimiento)<=$dia2 AND a.estado = 1 and e.codigoid='117'
        GROUP BY
              Proceso
        HAVING
              saldo > 0 or saldo < 0";
        $cuentasxpagar = DB::select($s_InfoCxp);
        $totalcxp = (float) $cuentasxpagar[0]->saldo;
        session(['vs_totalventas' => $totalventas]);
        session(['vs_totalpedidos' => $totalpedidos]);
        session(['vs_totalcartera' => $totalcartera]);
        session(['vs_totalcxp' => $totalcxp]);
        session(['vs_anoproceso' => $anoproceso]);
        return view ('home.home', compact('totalventas','totalpedidos','totalcartera','totalcxp','anoproceso'));
   }
}
