<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query;

use DateTime;
use App\Models\producto;
use App\Models\detalledemiscelaneo;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class ActualizarProductosController extends Controller
{
    public function index()
    {
      //$productos = producto::orderBy('descripcion')->where('estado','=',1)->get();
      //return view('productos.index',compact('productos'));
      return view('productos.index');
    }

    public function edit($id)
    {
        $productos1 = DB::table('producto')->select('producto.productoID','producto.descripcion','producto.codigo','producto.rutafoto','producto.imagen','producto.valorventa','grupoid.descripcion as nombregrupo','subgrupoid.descripcion as nombresubgrupo')
            ->leftjoin('detallemiscelaneos as grupoid', 'producto.grupo', '=', 'grupoid.codigo')
            ->leftjoin('detallemiscelaneos as subgrupoid', 'producto.subgrupo', '=', 'subgrupoid.codigo')
            ->where('producto.estado','=',1)
            ->where('grupoid.codigoid','=','110')
            ->where('subgrupoid.codigoid','=','111')
            ->where('estado','=',1)
            ->where('productoID','=',$id)
            ->orderBy('producto.descripcion')
            ->get();
        //$productosdedt = $productosedt[0];  // Se pasa sólo un registro de la colección
        //$productosedt = producto::find($id);
        //dd($productosedt);
        foreach($productos1 as $productosedt)
        {
           return view('productos.edit',compact('productosedt'));
           break;
        }
    }

    public function update(Request $request, $id)
    {
        $productosupd = producto::find($id); //Get role specified by id

        //$filename = "";
       // dd($productosupd);
        if ($request->hasFile('imagen'))
        {
            $imagen = $request->file('imagen');

            if ( $imagen->getClientOriginalExtension() == 'jpg' || $imagen->getClientOriginalExtension() == 'png' ) {

                if (!file_exists(public_path('img/productos/'))) {
                    mkdir(public_path('img/productos/'));
                }
                if ($productosupd->imagen <> null){
                  unlink(public_path('img/productos/'.$productosupd->imagen)); //eliminar imagen
                }
                $hoyinicio = new datetime();
                $hoy = $hoyinicio->format('YmdHi').$productosupd->productoid;

                $filename = $hoy.$productosupd->productoID.'.'.$imagen->getClientOriginalExtension();

                Image::make($imagen)->fit(250)->save( public_path('img/productos/'.$filename ) );
                $productosupd->imagen = $filename;
            }else {
                $mensaje = 'La imagen de la Productos no es soportada';
            }
        }
        $productosupd->descripcion = $request->descripcion;
        $productosupd->update();

        return redirect()->route('productos.index')->with('flash_message','Información de Producto Actualizada Exitosamente');
    }



}
