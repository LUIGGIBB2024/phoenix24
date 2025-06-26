<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\detalledefactura;
use App\Models\detalledemiscelaneo;
use App\Models\detallederemision;
use App\Models\factura;
use App\Models\remision;
use App\Models\vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Pagination\Paginator;
use App\Support\Collection;
use Illuminate\Support\Facades\URL;

class ConsultarventasController extends Controller
{
    public function index()
    {
        $fechadesde = "2022-01-01";
        $fechahasta = "2022-01-31";
        return view ("ventas.index");
    }

    public function verdetalle($id,$prefijo)
    {
      if ($prefijo == "-REM-")
         {
           $detalle = detallederemision::find($id);
           $detalles = detallederemision::where('RemisionID',$id)->paginate(10);
           $remision = remision::find($id);
           return view ('ventas.verdetallerem',compact('detalles','remision'));

         }
      else
         {
            $detalles = detalledefactura::where('FacturasID',$id)->orderBy('detalledefacturas.producto')->paginate(10);
            $facturas = factura::find($id);
            return view ('ventas.verdetalle',compact('detalles','facturas'));
         }

    }

    public function reportarfacturas($indestado)
    {
       return view ("ventas.reportarfacturas",compact('indestado'));
    }

    public function editarfacturas($id,$prefijo)
    {
      if ($prefijo == "-REM-")
         {
           $detalle = detallederemision::find($id);
           $detalles = detallederemision::where('RemisionID',$id)->paginate(10);
           $remision = remision::find($id);
           return view ('ventas.verdetallerem',compact('detalles','remision'));

         }
      else
         {
            $facturas = factura::find($id);
            $clientes = cliente::find($facturas->ClientesID);
            return view ('ventas.editarfacturas',compact('facturas','clientes'));
         }

    }

    public function updatedfacturas(Request $request, $id)
    {
        $facturasupd = factura::findOrFail($id); //Get role specified by id
        //Validate name, email and password fields

        $indiest = 1;
        $url = $request->url;

        $facturasupd->estado03         = $request->estado03;
        $facturasupd->update();
        //dd($url);
        //$input = $request->only(['latitud','longitud']); //Retreive the name, email and password fields

        //$clientes->fill($input)->save();
        //return redirect()->route('clientes.index')
        //echo '<script type="text/javascript">'.
        //     ' a href="javascript:window.history.go(1)">'.
        //     '</script>';
       //return redirect($url)->with('flash_message','Información de Clientes Actualizada Exitosamente');
       //$(".botonregresar").trigger("click");'.
       //return redirect()->route('ventas.reportarfacturas',['indestado'=>1,'fecha1'=>$request->desdefecha,'fecha2'=>$request->hastafecha]);
       return redirect()->route('ventas.reportarfacturas',['indestado'=>1]);
    }

}
