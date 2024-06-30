<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use DateTime;
use Illuminate\Support\Facades\DB;
use  Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query;

class ActualizarclientesController extends Controller
{
    public function index()
    {
       //$clientes = DB::table('clientes')->orderBy('nombrecompleto')->get();
       //$clientes = Cliente::select('clientesId','nit','nombrecompleto','direccion','latitud','longitud')->orderBy('nombrecompleto','asc')->where('estado','=',1);
       //$clientes = Cliente::OrderBy('nombrecompleto','asc')->get();
       // $clientes = Cliente::OrderBy('nombrecompleto','ASC')->get();
       //$clientes = DB::select('Select clientesID, nombrecompleto, nit, sucursal, direccion, telefono, email, latitud, longitud FROM clientes WHERE estado=1 ORDER BY nombrecompleto');
       return view('clientes.index');
    }

    public function edit($id)
    {
       //$clien = DB::select("SELECT * FROM clientes WHERE clientesID = ".$id);
       //$clientes = cliente::find($id);
       //$clientesedt = DB::table('clientes')->where('clientesID','=',$id);
      // $clientesedt = cliente::find($id);
      $query = "
         SELECT clientes.clientesID, clientes.nombrecompleto, clientes.nit, clientes.direccion, detallemiscelaneos.descripcion as nombredelaciudad,vendedor.nombre as nombredelvendedor, clientes.latitud, clientes.longitud
         FROM clientes
         left join
              detallemiscelaneos on detallemiscelaneos.codigo = clientes.ciudad
         left join
               vendedor on vendedor.codigo = clientes.vendedor
         where
             clientes.clientesid = $id and detallemiscelaneos.codigoid='117'
         order by clientes.nombrecompleto";

       $clientesedt = DB::select($query);

       $clientesedt = $clientesedt[0];  // Se pasa sólo un registro de la colección
       return view('clientes.edit',compact('clientesedt'));
    }

    public function update(Request $request, $id)
    {
         $clientesupd = Cliente::findOrFail($id); //Get role specified by id

		//Validate name, email and password fields
        $this->validate($request, [
        	'latitud'=>'required',
            'longitud'=>'required',
        ]);
        $url = $request->url;
        $hoy = new DateTime();
        $clientesupd->latitud          = $request->latitud;
        $clientesupd->longitud         = $request->longitud;
        $clientesupd->fecha_updated    = $hoy;
        $clientesupd->update();

        //$input = $request->only(['latitud','longitud']); //Retreive the name, email and password fields

        //$clientes->fill($input)->save();
        //return redirect()->route('clientes.index')
        return redirect($url)
            ->with('flash_message','Información de Clientes Actualizada Exitosamente');
    }
}
