<?php

namespace App\Http\Controllers;

use App\Models\detalledemiscelaneo;
use App\Models\egreso;
use App\Models\proveedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Egresoscontroller extends Controller
{
    public function index()
    {
      return view ('egresos.index');
    }

    public function verdetalle($id)
    {

       $egresos = egreso::find($id);
       if ($egresos->estado01==0)
          return view ('egresos.verdetalle',compact('id','egresos'));
       else
          return view ('egresos.verdetalletpg',compact('id','egresos'));
    }

}
