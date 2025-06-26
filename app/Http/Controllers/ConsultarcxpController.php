<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cuentasporpagar;
use App\Models\proveedor;
use App\Models\detalledemiscelaneo;
use App\Models\detalledepagocxp;
use Illuminate\Support\Facades\DB;


class ConsultarcxpController extends Controller
{
    public function index()
    {
       return view ('cuentasxpagar.index');
    }


    public function verdetalle($id,$nombredeltercero,$saldo)
    {
      return view ('cuentasxpagar.verdetalle',compact('id','nombredeltercero','saldo'));
    }
}
