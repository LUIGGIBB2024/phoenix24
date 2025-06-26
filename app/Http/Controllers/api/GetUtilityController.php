<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Aperturadeservicio;
use App\Models\cliente;
use App\Models\detalledelista;
use App\Models\detalledemiscelaneo;
use App\Models\Lista;
use App\Models\producto;
use App\Models\Reportedeservicio;
use App\Models\saldosdeinventario;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class GetUtilityController extends Controller
{
    public function getListas():JsonResponse
    {
        $listas         = Lista::all();
        $detlistas      = detalledelista::all();
        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Listas de Precios',
             'listas'           => $listas,
             'detlistas'        => $detlistas,
            ],Response::HTTP_ACCEPTED);        
    }

    public function getProductos(Request $request):JsonResponse
    {
        $anop           = date('Y');
        $productos       = producto::select('productoID','codigo','descripcion','medida','grupo','subgrupo','division','porcentajeiva','factorlimitededescuentos','valorultimacompra','valorventa','unidadesxempaque')
                           ->where('estado',1)->where('facturable',1)->get();
        $saldos          = saldosdeinventario::select('saldosdeinventariosID','anodeproceso','producto','bodega','cantidad','cantidad1','costopromedio','ultimocosto')
                           ->where('anodeproceso',$anop)->get();  

        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Productos de la lista',
             'productos'        => $productos,
             'saldos'           => $saldos,
            ],Response::HTTP_ACCEPTED);
    }

    public function getClientes(Request $request):JsonResponse
    {
        $clientes       = cliente::select('clientesID','nit','sucursal','nombreprimero','apellidoprimero','nombrecompleto','direccion','telefono','email','lista','vendedor','ciudad','cupodecartera')
                                ->where('estado',1)->get();

        $ciudades       = detalledemiscelaneo::select('DetalleMiscelaneosID','codigoid','codigo','descripcion','codigodepartamento','codigomunicipio')
                                ->where("codigoid","=","117")->get();
        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Clientes y Ciudades',
             'clientes'         => $clientes,   
             'ciudades'         => $ciudades,        
            ],Response::HTTP_ACCEPTED);
    }
    
    public function getServicios(Request $request):JsonResponse
    {
        $aperturas       = Aperturadeservicio::select('id','fechareporte','numerodeservicios','totalservicios','totalcomisiones','observaciones','tipo','vendedor','estado','estado2')
                           ->orderBy('fechareporte', 'DESC')->where('estado','Activo')->get();

        $servicios       = Reportedeservicio::select('id','idregistro','producto','descripcion','vendedor','placa','fechadereporte','cantidad','valor','comision','porcentaje','observaciones','tipo','estado','estado2')
                           ->orderBy('fechadereporte', 'DESC')->where('estado','Activo')->get();
        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Aperturas y Servicios',
             'aperturas'        => $aperturas,   
             'servicios'        => $servicios,        
            ],Response::HTTP_ACCEPTED);
    }
}
