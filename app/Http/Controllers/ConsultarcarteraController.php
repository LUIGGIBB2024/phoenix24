<?php

namespace App\Http\Controllers;

use App\Models\cartera;
use App\Models\cliente;
use App\Models\detalledemiscelaneo;
use App\Models\detalledepago;
use App\Models\factura;
use App\Models\vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultarcarteraController extends Controller
{
    public function index()
    {
        $totalcartera = 0;
        session(['tot_cartera' => 0]);
        return view ('cartera.index',compact('totalcartera'));
    }

    public function vercarteramapa()
    {
            $vendedores = vendedor::orderBy('nombre','ASC')->where('estado','=',1)->get();
            $ciudades   = detalledemiscelaneo::orderBy('descripcion','ASC')->where('codigoid','=','117')->get();
            return view ('cartera.carteramapa',compact('vendedores','ciudades'));

    }

    public function verdetalle($id, $nombredelcliente, $saldo)
    {
       return view ('cartera.verdetalle',compact('id','nombredelcliente','saldo'));
    }

    public function verpagos($id,$nrofactura,$saldo)
    {
      $facturas = cartera::find($id);
      return view ('cartera.verpagos',compact('id','nrofactura','saldo','facturas'));
    }
}
