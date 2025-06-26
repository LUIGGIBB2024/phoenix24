<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\AutorizacionesController;
use App\Http\Controllers\api\CarteraController;
use App\Http\Controllers\api\CuentasxPagarController;
use App\Http\Controllers\api\GetUtilityController;
use App\Http\Controllers\api\OnlyInvoiceController;
use App\Http\Controllers\api\SendAperturasController;
use App\Http\Controllers\api\SendServiciosController;
use App\Http\Controllers\api\UpdatePedidosController;
use App\Http\Controllers\api\VentasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('test', function () {
    return "Hola Estoy Aqui";
});


Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('loginsw', [AuthController::class,'loginsw']);
Route::group(['middleware'=>['auth:sanctum']],function()
{
    // Rutas Información de Ventas
    Route::post('update-sales', [VentasController::class,'UpdateSales']);
    Route::post('consolidated-sales-center', [VentasController::class,'ConsolidatedSalesCenter']);
    Route::post('daily-sales-center', [VentasController::class,'DailySalesCenter']);
    Route::post('daily-detailed-sales', [VentasController::class,'DailyDetailedSales']);
    Route::post('daily-consolidated-sales', [VentasController::class,'DailyConsolidatedSales']);
    Route::get('consult-inventories', [VentasController::class,'ConsultInventories']);

    // Rutas Información de sólo una factura
    Route::post('only-invoice', [OnlyInvoiceController::class,'OnlyInvoice']);
    Route::post('only-client', [OnlyInvoiceController::class,'OnlyClient']);
    Route::post('only-detinvoice', [OnlyInvoiceController::class,'OnlyDetInvoice']);

    // Rutas Actualizar / Consultar Tabla de Control
    Route::post('update-control', [AuthController::class,'UpdateControl']);
    Route::get('consult-control', [AuthController::class,'ConsultControl']);

    // Autorizaciones de Documentos
    Route::post('authorize-documents', [AutorizacionesController::class,'AuthorizeDocuments']);
    Route::get('consult-documents', [AutorizacionesController::class,'ConsultDocuments']);
    Route::get('automatic-process-consultation', [AutorizacionesController::class,'AutomaticProcessConsultation']);
    Route::post('update-authorized-documents', [AutorizacionesController::class,'UpdateAuthorizedDocuments']);

    // Procesar Información de Cuentas por Cobrar
    Route::post('process-cxc', [CarteraController::class,'ProcessCxc']);
    Route::post('process-pagoscxc', [CarteraController::class,'ProcessPagosCxc']);
    Route::get('cartera-resumida', [CarteraController::class,'CarteraResumida']);
    Route::get('cartera-detallada', [CarteraController::class,'CarteraDetallada']);

    // Procesar Información de Cuentas por Pagar
    Route::post('process-cxp', [CuentasxPagarController::class,'ProcessCxp']);
    Route::get('cxp-resumida', [CuentasxPagarController::class,'CxpResumida']);
    Route::get('cxp-detallada', [CuentasxPagarController::class,'CxpDetallada']);
    
    // Procesar GetUtility
    Route::get('get-listas', [GetUtilityController::class,'getListas']);
    Route::get('get-productos', [GetUtilityController::class,'GetProductos']);
    Route::get('get-clientes', [GetUtilityController::class,'GetClientes']);
    Route::get('get-servicios', [GetUtilityController::class,'GetServicios']);

    // Procesar Pedidos (Actualización)
    Route::post('update-pedidos', [UpdatePedidosController::class,'UpdatePedidos']);
    Route::post('update-detpedidos', [UpdatePedidosController::class,'UpdateDetPedidos']);

    // Procesar Envios de Reporte de Servicios
    Route::post('send-servicios', [SendServiciosController::class,'SendServicios']);

    // Procesar Envios de Apertura de Servicios
    Route::post('send-aperturas', [SendAperturasController::class,'SendAperturas']);
   
});

