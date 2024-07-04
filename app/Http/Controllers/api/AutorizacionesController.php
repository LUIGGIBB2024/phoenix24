<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\autorizacion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Symfony\Component\HttpFoundation\Response;

class AutorizacionesController extends Controller
{
    public function AuthorizeDocuments():JsonResponse
    {
        $contador = 0;

        $autorizaciones = autorizacion::select(
            DB::raw("documentosautorizados.numerodedocumento as numerodedocumento"),
            DB::raw("documentosautorizados.tipodedocumento as tipodedocumento"),
            DB::raw("documentosautorizados.prefijo as prefijo"),
            DB::raw("documentosautorizados.tipo as tipo"),
            DB::raw("documentosautorizados.accion as accion"),
            DB::raw("documentosautorizados.fechadereporte as fechadereporte"),
            DB::raw("documentosautorizados.fechadesde as fechadesde"),
            DB::raw("documentosautorizados.fechahasta as fechahasta"),
            DB::raw("documentosautorizados.estado01 as estado01"),
            DB::raw("documentosautorizados.estado02 as estado02"),
            DB::raw("documentosautorizados.nit as nit"),
            DB::raw("documentosautorizados.sucursal as sucursal"),
            DB::raw("documentosautorizados.nombredeltercero as nombredeltercero"),
            DB::raw("documentosautorizados.pin as pin"),
            DB::raw("documentosautorizados.observaciones as observaciones"))
            ->where('documentosautorizados.estado01','=', 1)
            ->orderBy('documentosautorizados.fechadereporte','desc')
            ->get();

            return response()->json(
                [
                 'status'           => '200',
                 'msg'              => 'COnsulta Exitosa',
                 'datos'            => $autorizaciones
                ],Response::HTTP_ACCEPTED);
        }
}
