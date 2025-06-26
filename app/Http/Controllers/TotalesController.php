<?php

namespace App\Http\Controllers;

use App\Models\enlacevisual_nv;
use App\Models\factura;
use App\Models\remision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TotalesController extends Controller
{
    public function totalventas()
    {

       $empresa = enlacevisual_nv::find(1);
       $ano1    = trim($empresa->anofacturacion)."01";
       $ano2    = trim($empresa->anofacturacion)."12";
       $ventasrem = remision::where('estado', 1)->whereBetween('lapso', [$ano1,$ano2])->sum('totaldocumento');
       $ventas    = factura::where('estado', 1)->whereBetween('lapso', [$ano1,$ano2])->sum('totalfactura');
       $total      = $ventas + $ventasrem;

       //dd("Facturas:".$ventas."Remisiones:".$ventasrem."Soy total ventas:".$total);

       //$ventas  =
       return view ('cartera.verdetalle',compact('id','nombredelcliente','saldo'));
    }
}
