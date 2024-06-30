<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cartera;
use App\Models\cliente;
use App\Models\conceptoscxcpago;
use App\Models\detalledepago;
use App\Models\factura;
use App\Models\Pedido;
use App\Models\recibosdecaja;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use  Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cookie;



class RecibosController extends Controller
{
    public function index()
    {
      return view ('recibos.index');
    }

    public function verdetalle($id)
    {
      $recibosObj  = DB::table('recibosdecaja')->select('recibosdecaja.recibosdecajaID as id','recibosdecaja.fechadocumento','recibosdecaja.consecutivo','recibosdecaja.tipodocumento','clientes.nombrecompleto as nombredelcliente',
            'recibosdecaja.valorefectivo','recibosdecaja.valorotro','detallemiscelaneos.descripcion as nombredelaciudad','vendedor.nombre as nombrevendedor','recibosdecaja.estado','clientes.vendedor')
            ->selectRaw('recibosdecaja.valorefectivo+recibosdecaja.valorotro as totalrecibo')
            ->selectRaw('CASE recibosdecaja.estado WHEN 1 THEN "Activo     " ELSE "Eliminado   " END AS estadorecibo')
            ->selectRaw('LPAD(recibosdecaja.consecutivo, 10, "0") AS consecutivorccaja')
            ->selectRaw('CASE recibosdecaja.estado WHEN 2 THEN recibosdecaja.valorefectivo+recibosdecaja.valorotro ELSE 0 END AS toteliminado')
            ->where('detallemiscelaneos.codigoid','=','117')
            ->where('recibosdecaja.recibosdecajaID','=',$id)
            ->leftjoin('clientes', 'recibosdecaja.nit', '=', 'clientes.nit')
            ->leftjoin('vendedor', 'recibosdecaja.vendedor', '=', 'vendedor.codigo')
            ->leftjoin('detallemiscelaneos', 'clientes.ciudad', '=', 'detallemiscelaneos.codigo')
            ->get();
      $recibos = $recibosObj[0];
      return view ('recibos.verdetalle',compact('recibos'));
    }

}
