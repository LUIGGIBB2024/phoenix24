<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\contenido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class ContenidoController extends Controller
{
    public function index()
    {
       return view ('contenidos.index');
    }

    public function create()
    {
      return view ('contenidos.create');
    }

    public function edit($id)
    {
        $contenidos = contenido::find($id);
        return view ('contenidos.edit',compact('contenidos'));
    }

     public function store(Request $request)
    {

        $this->validate($request, [
        	'idcontenido'=>'required',
            'titulo'=>'max:250',
            'pagina'=>'required',
            'ubicacion'=>'required|max:250',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8192',

        ]);

        $contenidos = new contenido;

        $contenidos->ubicacion      = $request->ubicacion;
        $contenidos->titulo         = $request->titulo;
        $contenidos->idcontenido    = $request->idcontenido;
        $contenidos->pagina         = $request->pagina;
        //$contenidos->imagen         = $request->file('imagen');
        $contenidos->usuario_updated  = Auth::user()->codigo;
        $contenidos->usuario_created  = Auth::user()->codigo;
        $ultimo = 0;
        if (contenido::count()>0)
           {
             $ultimo = $contenidos->get('id')->last();
             $ultimo =  $ultimo->id +  1;
             //dd('Entre aqui > 0');

           }
        else
        {
            $ultimo =  1;

        }

        if ($request->hasFile('imagen'))
        {

            $imagen = $request->file('imagen');

            if ( $imagen->getClientOriginalExtension() == 'jpg' || $imagen->getClientOriginalExtension() == 'png' ) {

                $hoyinicio = new datetime();
                $hoy = $hoyinicio->format('YmdHis').$ultimo;

                //$filename = $contenidos->imagen;
                $filename = $hoy.'.'.$imagen->getClientOriginalExtension();
                if (!file_exists(public_path('img/contenidos_image/'))) {
                    mkdir(public_path('img/contenidos_image/'));
                }
                if ($contenidos->imagen <> null){
                  unlink(public_path('img/contenidos_image/'.$filename)); //eliminar imagen
                }

                Image::make($imagen)
                    ->resize(1360,700,function($constraint)
                    {
                       $constraint->aspectRatio();
                    })->save( public_path('img/contenidos_image/'.$filename ) );
                $contenidos->imagen = $filename;
            }
            else {
                $mensaje = 'La imagen del Contenido no es soportada';
            }
        }
        $contenidos->save();
        return redirect()->route('contenidos.index')->with('flash_message','Información de Contenidos Actualizada Exitosamente');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
        	'idcontenido'=>'required',
            'ubicacion'=>'required|max:250',
            'titulo'=>'required|max:250',
            'pagina'=>'required',
        ]);
        $contenidos = contenido::find($id);
        $contenidos->ubicacion      = $request->ubicacion;
        $contenidos->titulo         = $request->titulo;
        $contenidos->idcontenido    = $request->idcontenido;
        $contenidos->pagina         = $request->pagina;
        //$contenidos->imagen         = $request->file('imagen');
        $contenidos->usuario_updated  = Auth::user()->codigo;
        $ultimo = $contenidos->id;

        if ($request->hasFile('imagen'))
        {

            $imagen = $request->file('imagen');

            if ( $imagen->getClientOriginalExtension() == 'jpg' || $imagen->getClientOriginalExtension() == 'png' ) {

                $filename = $contenidos->imagen;
                if (!file_exists(public_path('img/contenidos_image/'))) {
                    mkdir(public_path('img/contenidos_image/'));
                }
                if ($contenidos->imagen <> null){
                  unlink(public_path('img/contenidos_image/'.$contenidos->imagen)); //eliminar imagen
                }

                $hoyinicio = new datetime();
                $hoy = $hoyinicio->format('YmdHis').$ultimo;

                //$filename = $contenidos->imagen;
                $filename = $hoy.'.'.$imagen->getClientOriginalExtension();
                //dd('Entre Aqui final 0 '.$filename);
                //Image::make($imagen)->fit(250)->save(public_path('img/contenidos_image/'.$filename ) );
                Image::make($imagen)
                    ->resize(1368,700,function($constraint)
                    {
                       $constraint->aspectRatio();
                    })->save(public_path('img/contenidos_image/'.$filename));


                $contenidos->imagen = $filename;

            }
            else {
                $mensaje = 'La imagen del Contenido no es soportada';
            }
        }
        $contenidos->save();
        //dd('Entre Aqui final 2');
        return redirect()->route('contenidos.index')->with('flash_message','Información de Contenidos Actualizada Exitosamente');
    }

    public function destroy($id)
    {
        $contenidos = contenido::find($id);

        $contenidos->delete();
        return redirect()->route('contenidos.index')->with('flash_message','Regitro Eliminado Exitosamente');
    }
}
