<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Contracts\Encryption\DecryptException;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function store(Request $request)
    {
         $request->validate(
         [
            'email' => 'required|unique:users',
            'nombre' => 'required',
            'password' => 'required',
            'tipodeusuario' => 'required',
            'codigo' => 'required',
         ]);

         $usuario = User::create(
            [
               'email' => $request->email,
               'name' => $request->nombre,
               'codigo' => $request->codigo,
               'tipodeusuario' => $request->tipodeusuario,
               'password' => Hash::make($request->password),
               'passwordmobil' => encrypt($request->password),
               'tipodecalculo' => $request->tipodehabitacion,
               'vendedor' => '001',
               'profesional' => '',
               'especialidad' => '',
               'profile_photo_path' => '',
               'usuario_created' =>Auth::user()->codigo,
               'usuario_updated' =>Auth::user()->codigo,
            ]);

        return ['status'=>'200','mensaje'=>"Creación Correcta"];

    }

    public function actualizarUsuarios(Request $request)
    {
        $request->validate(
            [
               'nombre' => 'required',
               'password' => 'required',
               'tipodeusuario' => 'required',
               'codigo' => 'required',
            ]);

            $id  = $request->post('id');
            $reg_usuarios = User::updateOrCreate(['id'=>$id],
            [
            'email'                 => $request->email,
            'name'                  => $request->nombre,
            'codigo'                => $request->codigo,
            'tipodeusuario'         => $request->tipodeusuario,
            'password'              => Hash::make($request->password),
            'passwordmobil'         => encrypt($request->password),
            'tipodecalculo'         => $request->tipodehabitacion,
            'vendedor'              => '001',
            'profesional'           => '',
            'especialidad'          => '',
            'profile_photo_path'    => '',
            'usuario_created'       =>Auth::user()->codigo,
            'usuario_updated'       =>Auth::user()->codigo
            ]);
            // $reg_usuarios->save();
            return json_encode($reg_usuarios);

    }

    public function obtenerUsuarios(Request $request)
    {
       $id  = $request->get('id');
       $reg_usuarios = User::find($id);
       $contraseña= "";
       if (is_null($reg_usuarios->passwordmobil))
       {
          $contraseña   = "12345";
          $reg_usuarios->passwordmobil = $contraseña;
       }
       else
       {
        //$reg_usuarios->passwordmobil = decrypt($reg_usuarios->passwordmobil);
        try {
            $reg_usuarios->passwordmobil = decrypt($reg_usuarios->passwordmobil);

        } catch (DecryptException $e) {
            //
        }
       }
       return json_encode($reg_usuarios);
    }

    public function eliminar_usuarios(Request $request)
    {
        $id         = $request->post('id');
        $registro   = User::find($id);
        $registro->delete();
        return json_encode($registro);
    }
}

