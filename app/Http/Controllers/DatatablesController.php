<?php

namespace App\Http\Controllers;

use App\Models\cartera;
use Illuminate\Http\Request;
use App\Models\cliente;
use App\Models\conceptoscxcpago;
use App\Models\contenido;
use App\Models\cuentasporpagar;
use App\Models\detalledepago;
use App\Models\Detalledepedido;
use App\Models\enlacevisual_nv;
use App\Models\factura;
use App\Models\Pedido;
use App\Models\proveedor;
use App\Models\recibosdecaja;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use  Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cookie;

class DatatablesController extends Controller
{
    public function index()
    {
       //$clientes = cliente::select('clientesID','nit','sucursal','nombrecompleto','direccion','vendedor','ciudad','telefono','latitud','longitud')->orderBy('nombrecompleto','ASC')->get();
       //$clientes = DB::select("SELECT * FROM clientes");
       //$clientes = DB::select('Select clientesID, nombrecompleto, nit, sucursal, direccion, telefono, email, ciudad, vendedor, latitud, longitud FROM clientes WHERE estado=1 ORDER BY nombrecompleto');
       $clientes = DB::table('clientes')->select('clientes.clientesID','clientes.nombrecompleto','clientes.nit','clientes.direccion','detallemiscelaneos.descripcion as nombredelaciudad','vendedor.nombre as nombredelvendedor','clientes.latitud','clientes.longitud')
       ->where('clientes.estado','=',1)
       ->where('detallemiscelaneos.codigoid','=','117')
       ->orderBy('clientes.nombrecompleto')
       ->leftjoin('vendedor', 'clientes.vendedor', '=', 'vendedor.codigo')
       ->leftjoin('detallemiscelaneos', 'clientes.ciudad', '=', 'detallemiscelaneos.codigo')
       ->get();
       return datatables()->of($clientes)
       ->addcolumn('btn','clientes.botoneditar')
       ->rawcolumns(['btn'])
       ->toJson();
    }

    public function verdctosdeinventarios($fecha1, $fecha2)
      {
          $fechadesde = $fecha1;
          $fechahasta = $fecha2;
          $dctoscons = DB::table('documentosdeinventarios')->select('documentosdeinventarios.documentosdeinventariosID','documentosdeinventarios.fechademovimiento','documentosdeinventarios.consecutivo','documentosdeinventarios.concepto',
          'documentosdeinventarios.nit','documentosdeinventarios.sucursal','documentosdeinventarios.valordocumento','documentosdeinventarios.totaldocumento','documentosdeinventarios.valoriva','documentosdeinventarios.retefuente',
          'documentosdeinventarios.reteiva','documentosdeinventarios.reteica','documentosdeinventarios.descuentoproductos','documentosdeinventarios.descuentoadicional','documentosdeinventarios.estado','documentosdeinventarios.estado02',
          'proveedores.nombrecompleto','conceptoinv.descripcion as descripcioncpto')
              ->selectRaw('CASE documentosdeinventarios.estado02 WHEN 1 THEN "Pendiente " ELSE "Procesada  " END AS estadodcto')
              ->selectRaw('CASE documentosdeinventarios.estado   WHEN 1 THEN "Activo    " ELSE "Eliminado  " END AS estado')
              ->selectRaw('LPAD(documentosdeinventarios.consecutivo, 10, "0") AS consecutivocustom')
              ->whereBetween('documentosdeinventarios.fechademovimiento', [$fechadesde,$fechahasta])
              ->leftjoin('proveedores', 'documentosdeinventarios.nit', '=', 'proveedores.nit')
              ->leftjoin('conceptoinv', 'documentosdeinventarios.concepto', '=', 'conceptoinv.codigo')
              ->orderBy('documentosdeinventarios.fechademovimiento')->get();
           $totc = 0;
           return datatables()->of($dctoscons)
           ->addcolumn('btn','dctosdeinventarios.botonacciones')
           ->rawcolumns(['btn'])
           ->toJson();
      }

      public function verdetalledctos($id)
      {
        $detalle = DB::table('documentosdeinventarios')->select('documentosdeinventarios.documentosdeinventariosID','documentosdeinventarios.fechademovimiento','documentosdeinventarios.consecutivo','documentosdeinventarios.concepto',
            'documentosdeinventarios.nit','documentosdeinventarios.sucursal','documentosdeinventarios.valordocumento','documentosdeinventarios.totaldocumento','documentosdeinventarios.valoriva','documentosdeinventarios.retefuente',
            'documentosdeinventarios.reteiva','documentosdeinventarios.reteica','documentosdeinventarios.descuentoproductos','documentosdeinventarios.descuentoadicional','documentosdeinventarios.estado','documentosdeinventarios.estado02',
            'proveedores.nombrecompleto','conceptoinv.descripcion as descripcioncpto','movimientosdeinventarios.producto','movimientosdeinventarios.descripcion','movimientosdeinventarios.bodega','movimientosdeinventarios.cantidad','movimientosdeinventarios.valor',
            'movimientosdeinventarios.costoreal','movimientosdeinventarios.ivaproducto','movimientosdeinventarios.descuento1','movimientosdeinventarios.descuento2','movimientosdeinventarios.movimientosdeinventariosID')
                ->selectRaw('CASE documentosdeinventarios.estado02 WHEN 1 THEN "Pendiente " ELSE "Procesada  " END AS estadodcto')
                ->selectRaw('CASE documentosdeinventarios.estado   WHEN 1 THEN "Activo    " ELSE "Eliminado  " END AS estado')
                ->selectRaw('LPAD(documentosdeinventarios.consecutivo, 10, "0") AS consecutivocustom')
                ->selectRaw('round(movimientosdeinventarios.cantidad * movimientosdeinventarios.valor,0)  AS valorneto')
                ->where('documentosdeinventarios.documentosdeinventariosID', $id)
                ->leftjoin('proveedores', 'documentosdeinventarios.nit', '=', 'proveedores.nit')
                ->leftjoin('conceptoinv', 'documentosdeinventarios.concepto', '=', 'conceptoinv.codigo')
                ->leftjoin('movimientosdeinventarios', 'movimientosdeinventarios.documentosdeinventariosID','=','documentosdeinventarios.documentosdeinventariosID')
                ->orderBy('documentosdeinventarios.fechademovimiento')->get();
            $totc = 0;
            return datatables()->of($detalle)
            ->addcolumn('btn','dctosdeinventarios.botonacciones')
            ->rawcolumns(['btn'])
            ->toJson();
      }

    public function actproductos()
    {
       //$clientes = cliente::select('clientesID','nit','sucursal','nombrecompleto','direccion','vendedor','ciudad','telefono','latitud','longitud')->orderBy('nombrecompleto','ASC')->get();
       //$clientes = DB::select("SELECT * FROM clientes");
       //$clientes = DB::select('Select clientesID, nombrecompleto, nit, sucursal, direccion, telefono, email, ciudad, vendedor, latitud, longitud FROM clientes WHERE estado=1 ORDER BY nombrecompleto');
       $productoscon = DB::table('producto')->select('producto.productoID','producto.descripcion','producto.codigo','producto.rutafoto','producto.imagen','producto.valorventa','grupoid.descripcion as nombregrupo','subgrupoid.descripcion as nombresubgrupo')
            ->leftjoin('detallemiscelaneos as grupoid', 'producto.grupo', '=', 'grupoid.codigo')
            ->leftjoin('detallemiscelaneos as subgrupoid', 'producto.subgrupo', '=', 'subgrupoid.codigo')
            ->where('producto.estado','=',1)
            ->where('grupoid.codigoid','=','110')
            ->where('subgrupoid.codigoid','=','111')
            ->orderBy('producto.descripcion')
            ->get();
       return datatables()->of($productoscon)
       ->addcolumn('btn','productos.botonacciones')
       ->rawcolumns(['btn'])
       ->toJson();
    }

    public function conscartera()
    {

       $dia1 = -99999999;
       $dia2 =  99999999;
       $s_InfoCartera =
       "SELECT a.ClientesID as id, c.nombrecompleto, d.nombre as vendedor, e.descripcion as nombredelaciudad, NVL(SUM(a.valorfactura),0) totalfacturas,
           NVL(SUM(pgo0.Abonos),0) totalabonos, (NVL(SUM(a.valorfactura),0)-NVL(SUM(pgo0.Abonos),0)) saldo, 000.00 Porcentaje,1 AS IdEdad, a.nit, a.sucursal, a.cuentasporcobrarID  FROM cuentasporcobrar a
        LEFT  JOIN (SELECT 1 tipoc, SUM(b.valor) Abonos, b.concepto, b.facturacxcID FROM detalledepagoscxc b GROUP BY b.facturacxcID) pgo0 ON a.cuentasporcobrarID = pgo0.facturacxcID
        left join  clientes             c on a.nit = c.nit and a.sucursal=c.sucursal
        left join  vendedor             d on a.vendedor = d.codigo
        left join  detallemiscelaneos   e on c.ciudad = e.codigo
        WHERE
           DATEDIFF(CURDATE(),a.fechadevencimiento)>=$dia1 AND DATEDIFF(CURDATE(),a.fechadevencimiento)<=$dia2 AND a.estado = 1 AND e.codigoID='117'
        GROUP BY
           a.nit, a.sucursal
        HAVING
            saldo > 0 or saldo < 0
        ORDER BY
           c.nombrecompleto ";

       $carteracons = DB::select($s_InfoCartera);
       $totc = 0;
       foreach($carteracons as $totcart)
       {
         $totc = $totc +  $totcart->saldo;
       }
        $tot_txt = number_format($totc);
        cookie::queue('total_cart',$tot_txt,60);
        return datatables()->of($carteracons)
       ->addcolumn('btn','cartera.botonacciones')
       ->rawcolumns(['btn'])
       ->toJson();
      }

      public function carteraverdetalle($id)
      {
        $dia1 = -99999999;
        $dia2 =  99999999;
        $s_InfoCarteraDet =
            "SELECT a.cuentasporcobrarID as id, a.fechafactura, a.fechadevencimiento, a.numerodefactura, a.tipodedocumento, a.prefijo, d.nombre as vendedor, e.descripcion as nombredelaciudad, NVL(SUM(a.valorfactura),0) totalfacturas,
                NVL(SUM(pgo0.Abonos),0) totalabonos, (NVL(SUM(a.valorfactura),0)-NVL(SUM(pgo0.Abonos),0)) saldo, 000.00 Porcentaje,1 AS IdEdad, a.nit, a.sucursal, a.cuentasporcobrarID as id, DATEDIFF(CURDATE(),a.fechadevencimiento) dias,
                CONCAT(LPAD(a.numerodefactura, 8, '0'),'>',a.tipodedocumento) AS nrofactura FROM cuentasporcobrar a
            LEFT  JOIN (SELECT 1 tipoc, SUM(b.valor) Abonos, b.concepto, b.facturacxcID FROM detalledepagoscxc b GROUP BY b.facturacxcID) pgo0 ON a.cuentasporcobrarID = pgo0.facturacxcID
            left join  clientes             c on a.nit = c.nit and a.sucursal=c.sucursal
            left join  vendedor             d on a.vendedor = d.codigo
            left join  detallemiscelaneos   e on c.ciudad = e.codigo
            WHERE
                DATEDIFF(CURDATE(),a.fechadevencimiento)>=$dia1 AND DATEDIFF(CURDATE(),a.fechadevencimiento)<=$dia2 AND a.estado = 1 AND e.codigoID='117' AND a.ClientesID = $id
            GROUP BY
                a.numerodefactura, a.tipodedocumento, a.prefijo
            HAVING
                saldo > 0 or saldo < 0
            ORDER BY
                a.fechafactura ";

        $carteracons = DB::select($s_InfoCarteraDet);
        return datatables()->of($carteracons)
        ->addcolumn('btn','cartera.detbotonacciones')
        ->rawcolumns(['btn'])
        ->toJson();

      }

      public function consultarcarteramapa($vendedor, $ciudad)
      {
        $dia1 = -99999999;
        $dia2 =  99999999;
        $s_InfoCartera =
        "SELECT a.ClientesID as id, c.nombrecompleto, d.nombre as vendedor, e.descripcion as nombredelaciudad, NVL(SUM(a.valorfactura),0) totalfacturas,
            NVL(SUM(pgo0.Abonos),0) totalabonos, (NVL(SUM(a.valorfactura),0)-NVL(SUM(pgo0.Abonos),0)) saldo, 000.00 Porcentaje,1 AS IdEdad, a.nit, a.sucursal,
            a.cuentasporcobrarID, c.latitud, c.longitud, c.direccion, c.telefono, c.email  FROM cuentasporcobrar a
        LEFT  JOIN (SELECT 1 tipoc, SUM(b.valor) Abonos, b.concepto, b.facturacxcID FROM detalledepagoscxc b GROUP BY b.facturacxcID) pgo0 ON a.cuentasporcobrarID = pgo0.facturacxcID
        left join  clientes             c on a.nit = c.nit and a.sucursal=c.sucursal
        left join  vendedor             d on a.vendedor = d.codigo
        left join  detallemiscelaneos   e on c.ciudad = e.codigo
        WHERE
            DATEDIFF(CURDATE(),a.fechadevencimiento)>=$dia1 AND DATEDIFF(CURDATE(),a.fechadevencimiento)<=$dia2 AND a.estado = 1 AND e.codigoID='117' AND a.vendedor=$vendedor AND c.ciudad = $ciudad
        GROUP BY
            a.nit, a.sucursal
        HAVING
            saldo > 0 or saldo < 0
        ORDER BY
            c.nombrecompleto ";

        $carteracons = DB::select($s_InfoCartera);
        return json_encode($carteracons);

      }

      public function verpagoscxc($id)
      {
        $factura = cartera::find($id);
        $detallepagos = DB::table('detalledepagoscxc')
            ->select('detalledepagoscxc.detallereccajasID as id','detalledepagoscxc.consecutivo','detalledepagoscxc.fechadocumento','detalledepagoscxc.documentopago',
                    'detalledepagoscxc.concepto','detalledepagoscxc.valor','detalledepagoscxc.numerodefactura','detalledepagoscxc.tipodocumento',
                    'detalledepagoscxc.cuota','detalledepagoscxc.prefijo','conceptospagoscxc.concepto as conceptodepago','conceptospagoscxc.descripcion as descripcionconceptodepago',
                    DB::raw('000000000000000 as acumulado'),  DB::raw('000000000000000 as saldo'),'conceptospagoscxc.tipodecalculo','conceptospagoscxc.aplicaracartera')
            ->selectRaw('CONCAT(LPAD(detalledepagoscxc.consecutivo, 8, "0"),">",detalledepagoscxc.documentopago) AS consecutivopago')
            ->selectRaw('CONCAT(LPAD(detalledepagoscxc.numerodefactura, 8, "0"),">",detalledepagoscxc.tipodocumento) AS facturapago')
            ->leftjoin('conceptospagoscxc', 'detalledepagoscxc.concepto', '=', 'conceptospagoscxc.concepto')
            ->where('facturacxcID',$id)
            ->get();

            $tot = 0;
            $sdo = $factura->valorfactura;
            foreach ($detallepagos as $detpago)
            {
              if ($detpago->tipodecalculo<=3 AND $detpago->aplicaracartera=1)
                {
                    $sdo = $sdo - $detpago->valor;
                    $tot = $tot + $detpago->valor;
                    $detpago->acumulado = $tot;
                    $detpago->saldo = $sdo;
                }
              else{
                    $detpago->acumulado = $tot;
                    $detpago->saldo = $sdo;
               }
            }

            return datatables()->of($detallepagos)
            ->toJson();
      }

      public function consventas($fecha1, $fecha2)
      {
        $fechadesde = $fecha1;
        $fechahasta = $fecha2;
        $ventasremcons = DB::table('remision')->select('remision.RemisionID as id','remision.fechadocumento as fechafactura','remision.fechadocumento as fechavencimiento','remision.consecutivo as numerodefactura','remision.tipodedocumento',
                 DB::raw('"-REM-" prefijo'),'remision.nombreventa','remision.valor as valorfactura','remision.valoriva','remision.totaldocumento as totalfactura','remision.valoradicional','remision.dsctosproductos as descuentosproductos','remision.dsctosadicionales as descuentosadicionales',
                 DB::raw('000000000000 as retefuente,0000000000000 reteiva,0000000000000 reteica,00000000000000000 descuentosproductos'),'detallemiscelaneos.descripcion as nombredelaciudad','vendedor.nombre as nombrevendedor','clientes.vendedor')
                ->selectRaw('CASE remision.estado WHEN 1 THEN "Activa     " ELSE "Eliminada   " END AS estadodocumento')
                ->selectRaw('CASE remision.estado WHEN 2 THEN remision.totaldocumento ELSE 0 END AS toteliminado')
                ->selectRaw('CONCAT(LPAD(remision.consecutivo, 8, "0"),">",remision.tipodedocumento) AS consecutivofactura')
                ->whereBetween('remision.fechadocumento', [$fechadesde,$fechahasta])
                ->where('detallemiscelaneos.codigoid','=','117')
                ->leftjoin('clientes', 'remision.nit', '=', 'clientes.nit')
                ->leftjoin('vendedor', 'clientes.vendedor', '=', 'vendedor.codigo')
                ->leftjoin('detallemiscelaneos', 'clientes.ciudad', '=', 'detallemiscelaneos.codigo');

             //   ->where('detallemiscelaneos.codigoid','=','117')

        $ventasfactcons = DB::table('facturas')->select('facturas.FacturasID as id','facturas.fechafactura','facturas.fechavencimiento','facturas.numerodefactura','facturas.tipodedocumento','facturas.prefijo','facturas.nombreventa',
                'facturas.valorfactura','facturas.valoriva','facturas.totalfactura','facturas.valoradicional','facturas.descuentosproductos','facturas.descuentosadicionales','facturas.retefuente','facturas.reteiva','facturas.reteica',
                'facturas.descuentosproductos','centrooperativo.nombre as nombredelaciudad','vendedor.nombre as nombrevendedor','clientes.vendedor')
                ->selectRaw('CASE facturas.estado WHEN 1 THEN "Activa     " ELSE "Eliminada   " END AS estadodocumento')
                ->selectRaw('CASE facturas.estado WHEN 2 THEN facturas.totalfactura ELSE 0 END AS toteliminado')
                ->selectRaw('CONCAT(LPAD(facturas.numerodefactura, 8, "0"),">",facturas.tipodedocumento) AS consecutivofactura')
                ->whereBetween('fechafactura', [$fechadesde,$fechahasta])
                ->unionAll($ventasremcons)
                ->leftjoin('clientes', 'facturas.ClientesID', '=', 'clientes.clientesID')
                ->leftjoin('vendedor', 'clientes.vendedor', '=', 'vendedor.codigo')
                ->leftjoin('centrooperativo', 'centrooperativo.codigo', '=', 'facturas.centrooper')
                ->orderBy('fechafactura')
                ->orderBy('nombredelaciudad')
                ->orderBy('numerodefactura')
                ->get();

        // $ventascons = $ventasfactcons->union($ventasremcons);
         $ventascons = $ventasfactcons;
         return datatables()->of($ventascons)
         ->addcolumn('btn','ventas.botonacciones')
         ->rawcolumns(['btn'])
         ->toJson();
        }

      public function reportarfacturas($fecha1, $fecha2)
      {
        $fechadesde = $fecha1;
        $fechahasta = $fecha2;
        $ventasremcons = DB::table('remision')->select('remision.RemisionID as id','remision.fechadocumento as fechafactura','remision.fechadocumento as fechavencimiento','remision.consecutivo as numerodefactura','remision.tipodedocumento',
                 DB::raw('"-REM-" prefijo'),'remision.nombreventa','remision.valor as valorfactura','remision.valoriva','remision.totaldocumento as totalfactura','remision.valoradicional','remision.dsctosproductos as descuentosproductos','remision.dsctosadicionales as descuentosadicionales',
                 DB::raw('000000000000 as retefuente,0000000000000 reteiva,0000000000000 reteica,00000000000000000 descuentosproductos'),'detallemiscelaneos.descripcion as nombredelaciudad','vendedor.nombre as nombrevendedor','clientes.vendedor')
                ->selectRaw('CASE remision.estado02 WHEN 0 THEN "Sin Entregar     " ELSE "Entregada    " END AS estadodocumento')
                ->selectRaw('CASE remision.estado WHEN 2 THEN remision.totaldocumento ELSE 0 END AS toteliminado')
                ->selectRaw('CONCAT(LPAD(remision.consecutivo, 8, "0"),">",remision.tipodedocumento) AS consecutivofactura')
                ->whereBetween('remision.fechadocumento', [$fechadesde,$fechahasta])
                ->where('detallemiscelaneos.codigoid','=','117')
                ->leftjoin('clientes', 'remision.nit', '=', 'clientes.nit')
                ->leftjoin('vendedor', 'clientes.vendedor', '=', 'vendedor.codigo')
                ->leftjoin('detallemiscelaneos', 'clientes.ciudad', '=', 'detallemiscelaneos.codigo');


        $ventasfactcons = DB::table('facturas')->select('facturas.FacturasID as id','facturas.fechafactura','facturas.fechavencimiento','facturas.numerodefactura','facturas.tipodedocumento','facturas.prefijo','facturas.nombreventa',
                'facturas.valorfactura','facturas.valoriva','facturas.totalfactura','facturas.valoradicional','facturas.descuentosproductos','facturas.descuentosadicionales','facturas.retefuente','facturas.reteiva','facturas.reteica',
                'facturas.descuentosproductos','detallemiscelaneos.descripcion as nombredelaciudad','vendedor.nombre as nombrevendedor','clientes.vendedor')
                ->selectRaw('CASE facturas.estado03 WHEN 0 THEN "Sin Entregar     " ELSE "Entregada   " END AS estadodocumento')
                ->selectRaw('CASE facturas.estado WHEN 2 THEN facturas.totalfactura ELSE 0 END AS toteliminado')
                ->selectRaw('CONCAT(LPAD(facturas.numerodefactura, 8, "0"),">",facturas.tipodedocumento) AS consecutivofactura')
                ->whereBetween('fechafactura', [$fechadesde,$fechahasta])
                ->where('detallemiscelaneos.codigoid','=','117')
                ->unionAll($ventasremcons)
                ->leftjoin('clientes', 'facturas.ClientesID', '=', 'clientes.clientesID')
                ->leftjoin('vendedor', 'clientes.vendedor', '=', 'vendedor.codigo')
                ->leftjoin('detallemiscelaneos', 'clientes.ciudad', '=', 'detallemiscelaneos.codigo')
                ->orderBy('fechafactura')->get();

        // $ventascons = $ventasfactcons->union($ventasremcons);
         $ventascons = $ventasfactcons;
         return datatables()->of($ventascons)
         ->addcolumn('btn','ventas.editbotonacciones')
         ->rawcolumns(['btn'])
         ->toJson();
        }

        public function conspedidos($fecha1, $fecha2)
        {
          $fechadesde = $fecha1;
          $fechahasta = $fecha2;
          $pedidoscons = DB::table('pedidos')->select('pedidos.PedidosID','pedidos.fechadocumento','pedidos.placa','pedidos.consecutivo','pedidos.tipodedocumento','pedidos.nombreventa',
          'pedidos.valorpedido','pedidos.valoriva','pedidos.totalpedido','pedidos.valoradicional','pedidos.dsctosproductos','pedidos.dsctosadicionales','pedidos.retefuente','pedidos.reteiva',
          'pedidos.reteica','detallemiscelaneos.descripcion as nombredelaciudad','vendedor.nombre as nombrevendedor','pedidos.estado','clientes.vendedor')
                  ->selectRaw('CASE pedidos.estado02 WHEN 1 THEN "Pendiente " ELSE "Procesada  " END AS estadopedido')
                  ->selectRaw('LPAD(pedidos.consecutivo, 10, "0") AS consecutivocustom')
                  ->where('pedidos.estado','=',1)
                  ->whereBetween('pedidos.fechadocumento', [$fechadesde,$fechahasta])
                  ->where('detallemiscelaneos.codigoid','=','117')
                  ->leftjoin('clientes', 'pedidos.nit', '=', 'clientes.nit')
                  ->leftjoin('vendedor', 'clientes.vendedor', '=', 'vendedor.codigo')
                  ->leftjoin('detallemiscelaneos', 'clientes.ciudad', '=', 'detallemiscelaneos.codigo')
                  ->orderBy('pedidos.fechadocumento')->get();
           $totc = 0;
           return datatables()->of( $pedidoscons)
           ->addcolumn('btn','pedidos.botonacciones')
           ->rawcolumns(['btn'])
           ->toJson();
        }

        public function pedidosverdetalle($id)
        {
            $detalles = DB::table('detalledelpedido')->select('*')
                ->selectRaw('000000000000 as valorneto')
                ->where('detalledelpedido.PedidosID','=',$id)
                ->get();

            foreach($detalles as $item)
            {
                $dscto1 = 0;
                $dscto2 = 0;
                $iva = 0;
                $subtotal  =  $item->cantidad * $item->valor;
                $dscto1 =  ($item->descuento1 > 0) ? $item->cantidad * $item->valor * $item->descuento1/100:0;
                $dscto2 =  ($item->descuento2 > 0) ? ($subtotal - $dscto1) * $item->descuento2/100:0;
                $iva    =  ($subtotal - $dscto1 - $dscto2) * (0 +($item->iva/100));
                $total  =  round(($subtotal - $dscto1 - $dscto2 + $iva),0);
                $item->valorneto =  $total;
            }
            return datatables()->of($detalles)
            ->toJson();
        }

        public function consrecibos($fecha1, $fecha2)
        {
          $fechadesde = $fecha1;
          $fechahasta = $fecha2;
          $reciboscons = DB::table('recibosdecaja')->select('recibosdecaja.recibosdecajaID as id','recibosdecaja.fechadocumento','recibosdecaja.consecutivo','recibosdecaja.tipodocumento','clientes.nombrecompleto as nombredelcliente',
                  'recibosdecaja.valorefectivo','recibosdecaja.valorotro','detallemiscelaneos.descripcion as nombredelaciudad','vendedor.nombre as nombrevendedor','recibosdecaja.estado','clientes.vendedor')
                  ->selectRaw('recibosdecaja.valorefectivo+recibosdecaja.valorotro as totalrecibo')
                  ->selectRaw('CASE recibosdecaja.estado WHEN 1 THEN "Activo     " ELSE "Eliminado   " END AS estadorecibo')
                  ->selectRaw('LPAD(recibosdecaja.consecutivo, 10, "0") AS consecutivorccaja')
                  ->selectRaw('CASE recibosdecaja.estado WHEN 2 THEN recibosdecaja.valorefectivo+recibosdecaja.valorotro ELSE 0 END AS toteliminado')
                  ->whereBetween('recibosdecaja.fechadocumento', [$fechadesde,$fechahasta])
                  ->where('detallemiscelaneos.codigoid','=','117')
                  ->leftjoin('clientes', 'recibosdecaja.nit', '=', 'clientes.nit')
                  ->leftjoin('vendedor', 'recibosdecaja.vendedor', '=', 'vendedor.codigo')
                  ->leftjoin('detallemiscelaneos', 'clientes.ciudad', '=', 'detallemiscelaneos.codigo')
                  ->orderBy('recibosdecaja.fechadocumento')->get();

           return datatables()->of($reciboscons)

          ->addcolumn('btn','recibos.botonacciones')
          ->rawcolumns(['btn'])
          ->toJson();
        }

        public function verpagosrecibos($id)
        {
            $detallepagos = DB::table('detalledepagoscxc')
              ->select('detalledepagoscxc.detallereccajasID as id','detalledepagoscxc.consecutivo','detalledepagoscxc.fechadocumento','detalledepagoscxc.documentopago',
                      'detalledepagoscxc.concepto','detalledepagoscxc.valor','detalledepagoscxc.numerodefactura','detalledepagoscxc.tipodocumento','detalledepagoscxc.recibodecajaID',
                      'detalledepagoscxc.cuota','detalledepagoscxc.prefijo','conceptospagoscxc.concepto as conceptodepago','conceptospagoscxc.descripcion as descripcionconceptodepago',
                      DB::raw('000000000000000 as acumulado'),  DB::raw('000000000000000 as saldo'),'conceptospagoscxc.tipodecalculo','conceptospagoscxc.aplicaracartera')
              ->selectRaw('CONCAT(LPAD(detalledepagoscxc.consecutivo, 8, "0"),">",detalledepagoscxc.documentopago) AS consecutivopago')
              ->selectRaw('CONCAT(LPAD(detalledepagoscxc.numerodefactura, 8, "0"),">",detalledepagoscxc.tipodocumento) AS facturapago')
              ->leftjoin('conceptospagoscxc', 'detalledepagoscxc.concepto', '=', 'conceptospagoscxc.concepto')
              ->where('recibodecajaID',$id)
              ->get();

              $tot = 0;
              $sdo = 0;
              foreach ($detallepagos as $detpago)
              {
               if ($detpago->tipodecalculo<=3 AND $detpago->aplicaracartera=1)
                 {
                     $sdo = $sdo - $detpago->valor;
                     $tot = $tot + $detpago->valor;
                     $detpago->acumulado = $tot;
                     $detpago->saldo = $sdo;
                 }
               else{
                     $detpago->acumulado = $tot;
                     $detpago->saldo = $sdo;
                }
              }

              return datatables()->of($detallepagos)
              ->toJson();
        }


        public function consegresos($fecha1, $fecha2)
        {
          $fechadesde = $fecha1;
          $fechahasta = $fecha2;
          $egresoscons = DB::table('egresos')->select('egresos.egresosID as id','egresos.fechadocumento','egresos.consecutivo','egresos.tipodedocumento','egresos.nombredeltercero',
                  'egresos.valorcxp','egresos.otrospagos','origendepagos.descripcion as origendelpago','egresos.estado','egresos.centrooper','egresos.lapso','egresos.numerodecheque')
                  ->selectRaw('egresos.valorcxp+egresos.otrospagos as totalegreso1')
                  ->selectRaw('CASE egresos.estado WHEN 1 THEN "Activo     " ELSE "Eliminado   " END AS estadodocumento')
                  ->selectRaw('CASE egresos.estado WHEN 1 THEN egresos.valorcxp+egresos.otrospagos ELSE egresos.valorcxp+egresos.otrospagos END AS totalegreso')
                  ->selectRaw('CASE egresos.estado WHEN 2 THEN egresos.valorcxp+egresos.otrospagos ELSE 0 END AS toteliminado')
                  ->selectRaw('CONCAT(LPAD(egresos.consecutivo, 10, "0"),">",egresos.tipodedocumento) AS consecutivoegreso')
                  ->whereBetween('egresos.fechadocumento', [$fechadesde,$fechahasta])
                  ->where('detallemiscelaneos.codigoid','=','117')
                  ->leftjoin('proveedores', 'egresos.nit', '=', 'proveedores.nit')
                  ->leftjoin('detallemiscelaneos', 'proveedores.ciudad', '=', 'detallemiscelaneos.codigo')
                  ->leftjoin('origendepagos', 'egresos.banco', '=', 'origendepagos.codigo')
                  ->orderBy('egresos.fechadocumento')->get();
          return datatables()->of($egresoscons)
          ->addcolumn('btn','egresos.botonacciones')
          ->rawcolumns(['btn'])
          ->toJson();
        }

        public function verpagosegresos($id)
        {
            $detallepagos = DB::table('detalledepagoscxp')
                ->select('detalledepagoscxp.detalledepagoscxpID as id','detalledepagoscxp.consecutivo','detalledepagoscxp.fechadocumento','detalledepagoscxp.documentopago',
                        'detalledepagoscxp.conceptodepago','detalledepagoscxp.valordelpago','detalledepagoscxp.numerodefactura','detalledepagoscxp.documentofactura','detalledepagoscxp.EgresosID',
                        'detalledepagoscxp.cuota','detalledepagoscxp.prefijo','conceptospagoscxp.concepto as conceptodepago','conceptospagoscxp.descripcion as descripcionconceptodepago',
                        DB::raw('000000000000000 as acumulado'),  DB::raw('000000000000000 as saldo'),'conceptospagoscxp.tipodecalculo','conceptospagoscxp.aplicaracxp')
                ->selectRaw('CONCAT(LPAD(detalledepagoscxp.consecutivo, 8, "0"),">",detalledepagoscxp.documentopago) AS consecutivopago')
                ->selectRaw('CONCAT(LPAD(detalledepagoscxp.numerodefactura, 8, "0"),">",detalledepagoscxp.documentofactura) AS facturapago')
                ->leftjoin('conceptospagoscxp', 'detalledepagoscxp.conceptodepago', '=', 'conceptospagoscxp.concepto')
                ->where('EgresosID',$id)
                ->get();

              $tot = 0;
              $sdo = 0;
              foreach ($detallepagos as $detpago)
              {
               if ($detpago->tipodecalculo<=3 AND $detpago->aplicaracxp=1)
                 {
                     $sdo = $sdo + $detpago->valordelpago;
                     $tot = $tot + $detpago->valordelpago;
                     $detpago->acumulado = $tot;
                     $detpago->saldo = $sdo;
                 }
               else{
                     $detpago->acumulado = $tot;
                     $detpago->saldo = $sdo;
                }
              }

              return datatables()->of($detallepagos)
              ->toJson();
        }

        public function verpagosegresostpg($id)
        {
            $detallepagos = DB::table('detalledeotrospagos')
                ->select('detalledeotrospagos.detalledeotrospagosID as id','detalledeotrospagos.consecutivo','detalledeotrospagos.fechadocumento','detalledeotrospagos.tipodocumento',
                        'detalledeotrospagos.conceptodepago','detalledeotrospagos.valordelpago','detalledeotrospagos.placa','detalledeotrospagos.propiedad','detalledeotrospagos.centrooper',
                        'detalledeotrospagos.proyecto','detalledeotrospagos.sproyecto','detalledeotrospagos.actividad','detallemiscelaneos.descripcion as descripcionconceptodepago',
                        'detalledeotrospagos.nittercero','detalledeotrospagos.sucursaltercero','proveedores.nombrecompleto',
                        DB::raw('000000000000000 as acumulado'),  DB::raw('000000000000000 as saldo'),'detallemiscelaneos.tipodemovimiento','detalledeotrospagos.cuenta')
                ->selectRaw('CONCAT(LPAD(detalledeotrospagos.consecutivo, 8, "0"),">",detalledeotrospagos.tipodocumento) AS consecutivopago')
                ->leftjoin('detallemiscelaneos', 'detalledeotrospagos.conceptodepago', '=', 'detallemiscelaneos.codigo')
                ->leftjoin('proveedores', 'detalledeotrospagos.nittercero', '=', 'proveedores.nit')
                ->where('detallemiscelaneos.codigoid','=','138')
                ->where('detalledeotrospagos.EgresosID',$id)
                ->where('detalledeotrospagos.estado',1)
                ->get();
              $tot = 0;
              $sdo = 0;
              foreach ($detallepagos as $detpago)
              {
              if ($detpago->tipodemovimiento=1)
                 {
                     $sdo = $sdo + $detpago->valordelpago;
                     $tot = $tot + $detpago->valordelpago;
                     $detpago->acumulado = $tot;
                     $detpago->saldo = $sdo;
                 }
               else
               {
                    $sdo = $sdo - $detpago->valordelpago;
                    $tot = $tot - $detpago->valordelpago;
                    $detpago->valordelpago = $detpago->valordelpago*-1;
                    $detpago->acumulado = $tot;
                    $detpago->saldo = $sdo;
                }
              }
              return datatables()->of($detallepagos)
              ->toJson();
        }

        public function conscuentasxpagar()
        {
            $dia1 = -99999999;
            $dia2 =  99999999;
            $s_InfoCxp =
            "SELECT
                 c.proveedoresID  as id, c.nombrecompleto, a.nit, e.descripcion nombredelaciudad, NVL(SUM(a.valorfactura),0) totalfacturas, NVL(SUM(pgo0.Abonos),0) totalabonos,
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
                  a.nit, a.sucursal
            HAVING
                  saldo > 0 or saldo < 0
            ORDER BY
                   c.nombrecompleto ";


            $cxpcons = DB::select($s_InfoCxp);
            return datatables()->of($cxpcons)
                ->addcolumn('btn','cuentasxpagar.botonacciones')
                ->rawcolumns(['btn'])
                ->toJson();

    }

    public function cxpverdetalle($id)
      {
        $dia1 = -99999999;
        $dia2 =  99999999;
        $s_InfoCxpDet =
        "SELECT
             a.cuentasporpagarID as id, c.nombrecompleto, a.nit, e.descripcion nombredelaciudad, NVL(SUM(a.valorfactura),0) totalfacturas, NVL(SUM(pgo0.Abonos),0) totalabonos,
             (NVL(SUM(a.valorfactura),0)-NVL(SUM(pgo0.Abonos),0)) saldo, 000.00 Porcentaje,1 AS IdEdad, a.sucursal, a.numerofactura, a.prefijo, a.tipodedocumento, a.fechafactura,
             a.fechadevencimiento, a.sucursal, DATEDIFF(CURDATE(),a.fechadevencimiento) dias, a.cuenta, CONCAT(LPAD(a.numerofactura, 10, '0'),'>',a.tipodedocumento) as nrofactura
        FROM
            cuentasporpagar a
        LEFT  JOIN 	(SELECT 1 tipoc,SUM(b.valordelpago) Abonos,b.conceptodepago concepto, b.facturacxpID FROM detalledepagoscxp b
                     GROUP BY b.facturacxpID) pgo0 ON a.cuentasporpagarID = pgo0.facturacxpID
        left join  proveedores          c on a.nit = c.nit and a.sucursal=c.sucursal
        left join  detallemiscelaneos   e on c.ciudad = e.codigo
        WHERE
             DATEDIFF(CURDATE(),a.fechadevencimiento)>=$dia1 AND DATEDIFF(CURDATE(),a.fechadevencimiento)<=$dia2 AND a.estado = 1 and e.codigoid='117' AND 	a.proveedoresID = $id
        GROUP BY
              a.nit, a.sucursal, a.numerofactura, a.tipodedocumento, a.prefijo
        HAVING
              saldo > 0 or saldo < 0
        ORDER BY
               c.nombrecompleto ";


        $cxpconsdet = DB::select( $s_InfoCxpDet);
        return datatables()->of($cxpconsdet)
            ->addcolumn('btn','cuentasxpagar.detbotonacciones')
            ->rawcolumns(['btn'])
            ->toJson();
    }

    public function verinventarios()
      {
        $anodeproceso = "";
        $listaxdefecto = "";
        $empresacontrol = enlacevisual_nv::find(1);
        if ($empresacontrol !== null)
        {
            $anodeproceso = $empresacontrol->anofacturacion;
            $listaxdefecto = $empresacontrol->listaxdefecto;
        }

        $productos = DB::table('saldosdeinventarios')->select('producto.productoID AS id','producto.descripcion AS descripciondelproducto','producto.fechaultimacompra','saldosdeinventarios.producto','saldosdeinventarios.bodega','saldosdeinventarios.anodeproceso','saldosdeinventarios.cantidad',
                'saldosdeinventarios.cantidad1','saldosdeinventarios.costopromedio','detalledelistas.valor','detalledelistas.iva','detallemiscelaneos.descripcion as descripciondelgrupo','detalledelistas.valorantesdeiva','detalledelistas.valorunifinal')
                ->selectRaw('round(saldosdeinventarios.cantidad*saldosdeinventarios.costopromedio,0) AS productovalorizado')
                ->selectRaw('CONCAT("B-",saldosdeinventarios.bodega) AS bodegacustom')
                ->where('saldosdeinventarios.cantidad','>',0)
                ->where('detallemiscelaneos.codigoid','=','110')
                ->where('saldosdeinventarios.anodeproceso','=',$anodeproceso)
                ->where('detalledelistas.codigo','=',$listaxdefecto)
                ->leftjoin('producto', 'saldosdeinventarios.producto', '=', 'producto.codigo')
                ->leftjoin('detallemiscelaneos', 'producto.grupo', '=', 'detallemiscelaneos.codigo')
                ->leftjoin('detalledelistas', 'saldosdeinventarios.producto', '=', 'detalledelistas.producto')
                ->orderBy('producto.descripcion')
                ->orderBy('bodegacustom','DESC')
                ->get();

        return datatables()->of( $productos)
            ->toJson();
    }

    public function conscontenidos()
        {
          $contenidos = contenido::orderBy('idcontenido');
          return datatables()->of( $contenidos)
           ->addcolumn('btn','contenidos.botonacciones')
           ->rawcolumns(['btn'])
           ->toJson();
        }


     public function usuarios()
      {
          $usuarios = DB::table('users')->select('users.id as id','users.email as email','users.name as name','users.codigo as codigo',
            'users.password as password','users.passwordmobil as passwordmobil','users.tipodeusuario as tipodeusuario')
            ->selectRaw('CASE users.tipodeusuario WHEN 1 THEN "Administrador    "  WHEN 2 THEN "Ventas      " ELSE "Gerencia       " END AS tipousuario')
            ->orderBy('id','asc')
            ->get();           

          return datatables()->of($usuarios)
            ->addcolumn('btn','users.botonacciones')
            ->rawcolumns(['btn'])
            ->toJson();
      }


}



//->addcolumn('imagen2','<img src="{{asset('."'"."img/productos/{{$productoscon->imagen}}"."'".")}}".'"'.">"."'")
//->addcolumn('imagen2','<img src="{{asset('."'"."img/productos/'".$productoscon->imagen."'".")  }}".'"'." style='width:35px;height:35px;'>"."'")
