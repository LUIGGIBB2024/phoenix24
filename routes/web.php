<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ActualizarclientesController;
use App\Http\Controllers\ActualizarProductosController;
use App\Http\Controllers\ConsultarcarteraController;
use App\Http\Controllers\ConsultarcxpController;
use App\Http\Controllers\ConsultarventasController;
use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\DatatablesController;
use App\Http\Controllers\Egresoscontroller;
use App\Http\Controllers\InventariosController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\RecibosController;
use App\Http\Controllers\TotalesController;
use App\Http\Controllers\UserController;
use App\Models\factura;
use App\Models\enlacevisual_nv;
use App\Models\Pedido;
use App\Models\remision;
use App\Models\User;
use Hamcrest\Core\IsNull;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Isset_;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    //return view('welcome');
    return redirect('/login');
});
Route::get('/inicio',[HomeController::class,'index'])->name('inicio');
Route::get('/acercade',[HomeController::class,'acercade'])->name('acercade');
Route::get('/mision',[HomeController::class,'mision'])->name('mision');

Route::get('/clientes/consclientes',[ActualizarclientesController::class,'index'])->name('clientes.index');

Route::get('/datatables/clientescons',[DatatablesController::class,'index'])->name('clientes.ajax');
Route::get('/datatables/productos',[DatatablesController::class,'actproductos'])->name('productos.ajax');
Route::get('/datatables/conscartera',[DatatablesController::class,'conscartera'])->name('cartera.ajax');
Route::get('/datatables/carteramapa/{vendedor}/{ciudad}',[DatatablesController::class,'consultarcarteramapa'])->name('consultarcarteramapa.ajax');
Route::get('/datatables/carteraverdetalle/{id}',[DatatablesController::class,'carteraverdetalle'])->name('carteraverdetalle.ajax');
Route::get('/datatables/varpagoscxc/{id}',[DatatablesController::class,'verpagoscxc'])->name('verpagoscxc.ajax');
Route::get('/datatables/consventas/{fecha1}/{fecha2}',[DatatablesController::class,'consventas'])->name('ventas.ajax');
Route::get('/datatables/reportarfacturas/{fecha1}/{fecha2}',[DatatablesController::class,'reportarfacturas'])->name('reportarfacturas.ajax');

Route::get('/datatables/pedidos/{fecha1}/{fecha2}',[DatatablesController::class,'conspedidos'])->name('pedidos.ajax');
Route::get('/datatables/pedidosverdetalle/{id}',[DatatablesController::class,'pedidosverdetalle'])->name('pedidosverdetalle.ajax');
Route::get('/datatables/recibos/{fecha1}/{fecha2}',[DatatablesController::class,'consrecibos'])->name('recibos.ajax');
Route::get('/datatables/recibosdetalle/{id}',[DatatablesController::class,'verpagosrecibos'])->name('verpagosrecibos.ajax');

Route::get('/datatables/cuentasxpagar',[DatatablesController::class,'conscuentasxpagar'])->name('cuentasxpagar.ajax');
Route::get('/datatables/cuentasxpagardetalle/{id}',[DatatablesController::class,'cxpverdetalle'])->name('cxpverdetalle.ajax');
Route::get('/datatables/inventarios',[DatatablesController::class,'verinventarios'])->name('verinventarios.ajax');
Route::get('/datatables/dctosdeinventarios/{fecha1}/{fecha2}',[DatatablesController::class,'verdctosdeinventarios'])->name('verdctosdeinventarios.ajax');
Route::get('/datatables/dctosverdetalle/{id}',[DatatablesController::class,'verdetalledctos'])->name('dctosverdetalle.ajax');

Route::get('/datatables/egresos/{fecha1}/{fecha2}',[DatatablesController::class,'consegresos'])->name('egresos.ajax');
Route::get('/datatables/egresosdetalle/{id}',[DatatablesController::class,'verpagosegresos'])->name('verpagosegresos.ajax');
Route::get('/datatables/egresosdetalletpg/{id}',[DatatablesController::class,'verpagosegresostpg'])->name('verpagosegresostpg.ajax');

Route::get('/datatables/egresosdetalletpg/{id}',[DatatablesController::class,'verpagosegresostpg'])->name('verpagosegresostpg.ajax');

Route::get('/datatables/contenidos',[DatatablesController::class,'conscontenidos'])->name('conscontenidos.ajax');

Route::get('/clientes/editclientes/{id}',[ActualizarclientesController::class,'edit'])->name('clientes.edit');
Route::put('/clientes/actclientes/{id}',[ActualizarclientesController::class,'update'])->name('clientes.update');

Route::get('/productos/consultar',[ActualizarproductosController::class,'index'])->name('productos.index');
Route::get('/productos/editproductos/{id}',[ActualizarproductosController::class,'edit'])->name('productos.edit');
Route::put('/productos/actproductos/{id}',[ActualizarproductosController::class,'update'])->name('productos.update');

Route::get('/inventarios/consultar',[InventariosController::class,'index'])->name('inventarios.consulta');
Route::get('/inventarios/consultar_saldos',[InventariosController::class,'saldos'])->name('inventarios.saldos');
Route::get('/inventarios/consultar_documentos',[InventariosController::class,'consultar_dctos'])->name('inventarios.consultar_documentos');
Route::get('/inventarios/verdetalle_documentos/{id}/{valor}',[InventariosController::class,'verdetalle'])->name('dctosdeinventarios.verdetalle');

Route::get('/cartera/consultarcartera',[ConsultarcarteraController::class,'index'])->name('cartera.index');
Route::get('/cartera/consultarcarteramapa',[ConsultarcarteraController::class,'vercarteramapa'])->name('carteramapa.index');
Route::get('/cartera/verdetalle/{id}/{nombredelcliente}/{saldo}',[ConsultarcarteraController::class,'verdetalle'])->name('cartera.verdetalle');
Route::get('/cartera/verpagos/{id}/{nrofactura}/{saldo}',[ConsultarcarteraController::class,'verpagos'])->name('cartera.verpagos');

Route::get('/cuentasxpagar/consultarcxp',[ConsultarcxpController::class,'index'])->name('cuentasxpagar.index');
Route::get('/cuentasxpagar/verdetalle/{id}/{nombredeltercero}/{saldo}',[ConsultarcxpController::class,'verdetalle'])->name('cuentasxpagar.verdetalle');
Route::get('/cuentasxpagar/verpagos/{id}/{nrofactura}/{saldo}',[ConsultarcxpController::class,'verpagos'])->name('cuentasxpagar.verpagos');

Route::get('/ventas/consultarventas',[ConsultarventasController::class,'index'])->name('ventas.index');
Route::get('/ventas/verdetalle/{id}/{prefijo}',[ConsultarventasController::class,'verdetalle'])->name('ventas.verdetalle');
Route::get('/ventas/reportarfacturas/{indestado}',[ConsultarventasController::class,'reportarfacturas'])->name('ventas.reportarfacturas');
Route::get('/ventas/editarfacturas/{id}/{prefijo}',[ConsultarventasController::class,'editarfacturas'])->name('ventas.editarfacturas');
Route::put('/ventas/updatedfacturas/{id}',[ConsultarventasController::class,'updatedfacturas'])->name('facturas.update');

Route::get('/pedidos/consultarpedidos',[PedidosController::class,'index'])->name('pedidos.index');
Route::get('/pedidos/verdetalle/{id}',[PedidosController::class,'verdetalle'])->name('pedidos.verdetalle');

Route::get('/recibos/consultarrecibos',[RecibosController::class,'index'])->name('recibos.index');
Route::get('/recibos/verdetalle/{id}',[RecibosController::class,'verdetalle'])->name('recibos.verdetalle');

Route::get('/egresos/consultaregresos',[EgresosController::class,'index'])->name('egresos.index');
Route::get('/egresos/verdetalle/{id}',[EgresosController::class,'verdetalle'])->name('egresos.verdetalle');

Route::get('/totales/ventas',[TotalesController::class,'totalventas'])->name('total.ventas');

Route::get('/contenidos/imagenes',[ContenidoController::class,'index'])->name('contenidos.index');
Route::get('/contenidos/create',[ContenidoController::class,'create'])->name('contenidos.create');
Route::post('/contenidos/store',[ContenidoController::class,'store'])->name('contenidos.store');
Route::get('/contenidos/edit/{id}',[ContenidoController::class,'edit'])->name('contenidos.edit');
Route::put('/contenidos/update/{id}',[ContenidoController::class,'update'])->name('contenidos.update');
Route::get('/contenidos/delete/{id}',[ContenidoController::class,'destroy'])->name('contenidos.delete');

Route::get('/user',[UserController::class,'index'])->name('user.index');
Route::get('/usuariosindex',[DatatablesController::class,'usuarios'])->name('usuarios.ajax');
Route::post('/crear-usuarios',[UserController::class,'store'])->name('usuarios.store');
Route::post('/actualizar-usuarios',[UserController::class,'actualizarUsuarios'])->name('usuarios.actualizar');
Route::post('/obtener-usuarios',[UserController::class,'obtenerUsuarios'])->name('filtrar.usuarios.ajax');
Route::post('/eliminar-usuarios',[UserController::class,'eliminar_usuarios'])->name('usuarios.eliminar');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
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
    Empty($totcartera) ? $totalcartera = 0 : $totalcartera = (float) $totcartera[0]->saldo;

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
    $totalcxp  = Empty($cuentasxpagar)? 0: (float) $cuentasxpagar[0]->saldo;
    session(['vs_totalventas' => $totalventas]);
    session(['vs_totalpedidos' => $totalpedidos]);
    session(['vs_totalcartera' => $totalcartera]);
    session(['vs_totalcxp' => $totalcxp]);
    session(['vs_anoproceso' => $anoproceso]);
    return view ('home.home', compact('totalventas','totalpedidos','totalcartera','totalcxp','anoproceso'));
})->name('home');


Route::middleware(['auth:sanctum', 'verified'])->get('/register', function () {
      return view ('auth.register');
})->name('register');
