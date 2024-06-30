<?php

namespace App\Http\Controllers;

use App\Models\detalledelista;
use App\Models\detalledemiscelaneo;
use App\Models\documentosdeinventario;
use App\Models\enlacevisual_nv;
use App\Models\producto;
use App\Models\saldosdeinventario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InventariosController extends Controller
{
    public function index()
    {
        $anodeproceso = "";
        $listaxdefecto = "";
        $empresacontrol = enlacevisual_nv::find(1);
        if ($empresacontrol !== null)
        {
            $anodeproceso = $empresacontrol->anofacturacion;
            $listaxdefecto = $empresacontrol->listaxdefecto;
        }

        $productos = DB::table('saldosdeinventarios')->select('producto.productoID','producto.descripcion AS descripciondelproducto','producto.fechaultimacompra','saldosdeinventarios.producto','saldosdeinventarios.bodega','saldosdeinventarios.anodeproceso','saldosdeinventarios.cantidad',
        'saldosdeinventarios.cantidad1','saldosdeinventarios.costopromedio','detalledelistas.valor','detalledelistas.iva','detallemiscelaneos.descripcion as descripciondelgrupo','detalledelistas.valorantesdeiva','detalledelistas.valorunifinal')
                ->selectRaw('round(saldosdeinventarios.cantidad*saldosdeinventarios.costopromedio,0) AS productovalorizado')
                ->where('saldosdeinventarios.cantidad','>',0)
                ->where('detallemiscelaneos.codigoid','=','110')
                ->where('saldosdeinventarios.anodeproceso','=',$anodeproceso)
                ->where('detalledelistas.codigo','=',$listaxdefecto)
                ->leftjoin('producto', 'saldosdeinventarios.producto', '=', 'producto.codigo')
                ->leftjoin('detallemiscelaneos', 'producto.grupo', '=', 'detallemiscelaneos.codigo')
                ->leftjoin('detalledelistas', 'saldosdeinventarios.producto', '=', 'detalledelistas.producto')
                ->orderBy('saldosdeinventarios.bodega')
                ->orderBy('producto.descripcion')
                ->get();

      return view ('inventarios.index');
    }

    public function consultar_dctos()
    {
        $anodeproceso = "";
        $listaxdefecto = "";
        $empresacontrol = enlacevisual_nv::find(1);
        if ($empresacontrol !== null)
        {
            $anodeproceso = $empresacontrol->anofacturacion;
            $listaxdefecto = $empresacontrol->listaxdefecto;
        }

        $productos = DB::table('saldosdeinventarios')->select('producto.productoID','producto.descripcion AS descripciondelproducto','producto.fechaultimacompra','saldosdeinventarios.producto','saldosdeinventarios.bodega','saldosdeinventarios.anodeproceso','saldosdeinventarios.cantidad',
        'saldosdeinventarios.cantidad1','saldosdeinventarios.costopromedio','detalledelistas.valor','detalledelistas.iva','detallemiscelaneos.descripcion as descripciondelgrupo','detalledelistas.valorantesdeiva','detalledelistas.valorunifinal')
                ->selectRaw('round(saldosdeinventarios.cantidad*saldosdeinventarios.costopromedio,0) AS productovalorizado')
                ->where('saldosdeinventarios.cantidad','>',0)
                ->where('detallemiscelaneos.codigoid','=','110')
                ->where('saldosdeinventarios.anodeproceso','=',$anodeproceso)
                ->where('detalledelistas.codigo','=',$listaxdefecto)
                ->leftjoin('producto', 'saldosdeinventarios.producto', '=', 'producto.codigo')
                ->leftjoin('detallemiscelaneos', 'producto.grupo', '=', 'detallemiscelaneos.codigo')
                ->leftjoin('detalledelistas', 'saldosdeinventarios.producto', '=', 'detalledelistas.producto')
                ->orderBy('producto.descripcion')
                ->orderBy('saldosdeinventarios.bodega')
                ->get();


      return view ('dctosdeinventarios.index');
    }

    public function verdetalle($id, $saldo)
    {
       $documentos = documentosdeinventario::find($id);
       return view ('dctosdeinventarios.verdetalle',compact('documentos'));
    }
//
}
