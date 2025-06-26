<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\centrodeoperacion;
use App\Models\cliente;
use App\Models\detalledefactura;
use App\Models\detalledelista;
use App\Models\detallederemision;
use App\Models\documentosdeinventario;
use App\Models\factura;
use App\Models\movimientosdeinventario;
use App\Models\producto;
use App\Models\proveedor;
use App\Models\saldosdeinventario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\enlacevisual_nv;
use App\Models\Lista;
use App\Models\miscelaneo;
use App\Models\remision;
use App\Models\vendedor;

use function PHPUnit\Framework\isNull;

class VentasController extends Controller
{
    public function UpdateSales(Request $request):JsonResponse
    {
        // Voidando las relaciones de claves foráneas   
        $contador = 0;
        if (isset($request->miscelaneos))
        {
           $miscelaneos  = $request->miscelaneos;
           foreach($miscelaneos as $dato)
           {
             $codigo          =   $dato['codigo'];
             $reg_info  = miscelaneo::updateOrCreate(['codigoid'=>$codigo],
             [
               'descripcion'                   => is_null($dato['descripcion'])?"":$dato['descripcion'],  
               'usuario_created'               => is_null($dato['usuariocreated'])?"":$dato['usuariocreated'],
               'usuario_updated'               => is_null($dato['usuarioupdated'])?"":$dato['usuarioupdated'],
             ]);
           }
        }

        $contador = 0;
        if (isset($request->listas))
        {
           $listas  = $request->listas;
           foreach($listas as $dato)
           {
             $codigo          =   $dato['codigo'];
             $reg_info  = Lista::updateOrCreate(['codigo'=>$codigo],
             [
               'descripcion'                   => $dato['descripcion'],
               'tipomoneda'                    => $dato['tipomoneda'],
               'factor'                        => $dato['factor'],
               'proyecto'                      => is_null($dato['proyecto'])?"":$dato['proyecto'],
               'sproyecto'                     => is_null($dato['sproyecto'])?"":$dato['sproyecto'],
               'centrooper'                    => is_null($dato['centrooper'])?"":$dato['centrooper'],
               'estado'                        => $dato['estado'],
               'usuario_created'               => is_null($dato['usuariocreated'])?"":$dato['usuariocreated'],
               'usuario_updated'               => is_null($dato['usuarioupdated'])?"":$dato['usuarioupdated'],
             ]);
           }
        }

        $contador = 0;
        if (isset($request->vendedores))
        {
            $vendedores  = $request->vendedores;
            foreach($vendedores as $dato)
            {
              $codigo          =   $dato['codigo'];

              DB::statement('SET FOREIGN_KEY_CHECKS=0;');
              $reg_info  = vendedor::updateOrCreate(['codigo'=>$codigo],
              [
                'cedula'                        => is_null($dato['nit'])?"":$dato['nit'], 
                'sucursal'                      => is_null($dato['sucursal'])?"":$dato['sucursal'], 
                'nombre'                        => $dato['nombre'],
                'direccion'                     => "",
                'telefono'                      => "",
                'email'                         => "",
                'estado'                        => $dato['estado'],
                'tipo'                          => $dato['tipovendedor'],
                'tipodecomision'                => $dato['tipodecomisiones'],
                'turno'                         => is_null($dato['turno'])?"":$dato['turno'],
                'centrooper'                    => is_null($dato['centrooper'])?"":$dato['centrooper'],
                'centrooperativoid'             => 0,
                'usuario_created'               => is_null($dato['usuariocreated'])?"":$dato['usuariocreated'],
                'usuario_updated'               => is_null($dato['usuarioupdated'])?"":$dato['usuarioupdated'],
              ]);
              DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            }            
        }
      

        $contador = 0;
        if (isset($request->productos))
        {
            $productos  = $request->productos;

            foreach ($productos as $dato)
            {
              $codigo          =   $dato['codigo'];
              $reg_info  = producto::updateOrCreate(['codigo'=>$codigo],
              [
                'codigobarra'                   => $dato['codigobarra'],
                'codicorto  '                   => "",
                'descripcion'                   => $dato['descripcion'],
                'presentacion'                  => $dato['presentacion'],
                'porcentajeiva'                 => $dato['porcentajeiva'],
                'factordeconversion'            => $dato['factorconversion'],
                'factorderentabilidad'          => $dato['factorrentabilidad'],
                'factorlimitededescuentos'      => $dato['factorlimitedescuentos'],
                'valorultimacompra'             => $dato['valorcompra'],
                'valorventa'                    => $dato['valorventa'],
                'costopromedio'                 => $dato['valorcosteo'],
                'ultimocosto'                   => $dato['valorcompra'],
                'fechaultimacompra'             => $dato['fechaultimacompra'],
                'fechaultimacompra'             => $dato['fechaultimacompra'],
                'unidadesxempaque'              => $dato['unidadxemb'],
                'medida'                        => is_null($dato['medida'])?"":$dato['medida'],
                'grupo'                         => is_null($dato['grupo'])?"":$dato['grupo'],
                'subgrupo'                      => is_null($dato['subgrupo'])?"":$dato['subgrupo'],
                'division'                      => is_null($dato['division'])?"":$dato['division'],
                'familia'                       => is_null($dato['familia'])?"":$dato['familia'],
                'referencia'                    => is_null($dato['referencia'])?"":$dato['referencia'],
                'agruparen'                     => is_null($dato['agruparen'])?"":$dato['agruparen'],
                'categoria01'                   => is_null($dato['categoria01'])?"":$dato['categoria01'],
                'categoria02'                   => is_null($dato['categoria02'])?"":$dato['categoria02'],
                'categoria03'                   => is_null($dato['categoria03'])?"":$dato['categoria03'],
                'tipodeproducto'                => $dato['tipoproducto'],
                'tipodecontrol'                 => $dato['tipocontrol'],
                'tipocalculo'                   => $dato['tipocalculo'],
                'ubicacion'                     => is_null($dato['ubicacion'])?"":$dato['ubicacion'],
                'stockminimo'                   => $dato['minimo'],
                'stockmaximo'                   => $dato['maximo'],
                'facturable'                    => $dato['manejapeso'],
                'requierebascula'               => $dato['estado01'],
                'pesodelproducto'               => $dato['pesoproducto'],
                'impuestoalconsumo'             => $dato['impuestoconsumo'],
                'codigocie10'                   => is_null($dato['codigocie10'])?"":$dato['codigocie10'],
                'codigoalterno'                 => is_null($dato['codigoalterno'])?"":$dato['codigoalterno'],
                'codigocups'                    => is_null($dato['codigocups'])?"":$dato['codigocups'],
                'codigocum'                     => is_null($dato['codigocum'])?"":$dato['codigocum'],
                'registroinvima'                => is_null($dato['registroinvima'])?"":$dato['registroinvima'],
                'estado'                        => $dato['estado'],
                'estado01'                      => $dato['estado01'],
                'rutafoto'                      => is_null($dato['rutafoto'])?"":$dato['rutafoto'],
                'codigobarracaja'               => "",
                'usuario_created'               => is_null($dato['usuariocreated'])?"":$dato['usuariocreated'],
                'usuario_updated'               => is_null($dato['usuarioupdated'])?"":$dato['usuarioupdated'],
              ]);
            }
        }

         $contador = 0;
         if (isset($request->proveedores))
         {
             $proveedores   = $request->proveedores;
             foreach ($proveedores as $dato)
             {
               $nit          =   $dato['nit'];
               $sucursal     =   $dato['sucursal'];
               $reg_proveedor = proveedor::updateOrCreate(['nit'=>$nit,'sucursal'=>$sucursal],
               [
                 'dv'                   => !is_null($dato['dv'])?$dato['dv']:"",
                 'nombreprimero'         => !is_null($dato['nombreprimero'])?$dato['nombreprimero']:"",
                 'nombresegundo'         => !is_null($dato['nombresegundo'])?$dato['nombresegundo']:"",
                 'apellidosegundo'       => !is_null($dato['apellidosegundo'])?$dato['apellidosegundo']:"",
                 'apellidoprimero'       => !is_null($dato['apellidoprimero'])?$dato['apellidoprimero']:"",
                 'nombrecompleto'        => !is_null($dato['nombrecompleto'])?$dato['nombrecompleto']:"",
                 'razonsocial'           => !is_null($dato['razonsocial'])?$dato['razonsocial']:"",
                 'direccion'             => !is_null($dato['direccion'])?$dato['direccion']:"",
                 'telefono'              => !is_null($dato['telefono'])?$dato['telefono']:"",
                 'email'                 => !is_null($dato['emailf'])?$dato['emailf']:"",
                 'ciudad'                => !is_null($dato['ciudad'])?$dato['ciudad']:"",
                 'cargo'                 => !is_null($dato['cargo'])?$dato['cargo']:"",
                 'contacto'              => !is_null($dato['contacto'])?$dato['contacto']:"",
                 'telefonocontacto'      => !is_null($dato['telefonocontacto'])?$dato['telefonocontacto']:"",
                 'tipodecontribuyente'   => $dato['tipoderegimen'],
                 'actividadeconomica'    => !is_null($dato['actividadeconomica'])?$dato['actividadeconomica']:"",
                 'codigoprestador'       => !is_null($dato['codigoprestador'])?$dato['codigoprestador']:"",
                 'banco1'                => !is_null($dato['banco1'])?$dato['banco1']:"",
                 'tipodecuenta1'         => !is_null($dato['tipocuenta1'])?$dato['tipocuenta1']:"",
                 'numerodecuenta1'       => !is_null($dato['numerocuenta1'])?$dato['numerocuenta1']:"",
                 'banco2'                => !is_null($dato['banco2'])?$dato['banco2']:"",
                 'tipodecuenta2'         => !is_null($dato['tipocuenta2'])?$dato['tipocuenta2']:"",
                 'numerodecuenta2'       => !is_null($dato['numerocuenta2'])?$dato['numerocuenta2']:"",
                 'observaciones'         => !is_null($dato['observaciones'])?$dato['observaciones']:"",
                 'tipodeproveedor'       => !is_null($dato['tipoproveedor'])?$dato['tipoproveedor']:"",
                 'tipoestado'            => $dato['tipodeestado'],
                 'diasdeplazo'           => $dato['diasdeplazo'],
                 'consecutivodeprogramacion'  => $dato['consecutivodeprogramacion'],
                 'cuenta'                => "",
                 'centro'                => "",
                 'scentro'               => "",
                 'matriculamercantil'    => !is_null($dato['matriculamercantil'])?$dato['matriculamercantil']:"",
                 'obligacionesfiscales'  => !is_null($dato['rutobligaciones'])?$dato['rutobligaciones']:"",
                 'tipoderegimen'         => !is_null($dato['ruttiporegimen'])?$dato['ruttiporegimen']:0,
                 'zonapostal'            => !is_null($dato['zonapostal'])?$dato['zonapostal']:"",
                 'tipodedocumento'       => $dato['tipodedocumento'],
                 'tiporesidente'         => $dato['tiporesidente'],
                 'latitud'               => 0,
                 'longitud'              => 0,
                 'estado'                => $dato['estado'],
                 'estado01'              => 0,
                 'usuario_created'       => is_null($dato['usuariocreated'])?"":$dato['usuariocreated'],
                 'usuario_updated'       => is_null($dato['usuarioupdated'])?"":$dato['usuarioupdated'],
               ]);
             }
         }

        $contador = 0;
        if (isset($request->clientes))
        {

            $records   = $request->clientes;

            // Divide los registros en chunks
            $clientes = array_chunk($records, 1000);

            foreach ($clientes as $cli)
            {
              foreach ($cli as $dato)
              {
                  $nit          =   $dato['nit'];
                  $sucursal     =   $dato['sucursal'];
                  try
                  {
                    $reg_clientes = cliente::updateOrCreate(['nit'=>$nit,'sucursal'=>$sucursal],
                    [
                        'nit'                   => $dato['nit'],
                        'sucursal'              => $dato['sucursal'],
                        'nombreprimero'         => !is_null($dato['nombreprimero'])?$dato['nombreprimero']:"",
                        'nombresegundo'         => !is_null($dato['nombresegundo'])?$dato['nombresegundo']:"",
                        'apellidosegundo'       => !is_null($dato['apellidosegundo'])?$dato['apellidosegundo']:"",
                        'apellidoprimero'       => !is_null($dato['apellidoprimero'])?$dato['apellidoprimero']:"",
                        'nombrecompleto'        => !is_null($dato['nombrecompleto'])?$dato['nombrecompleto']:"",
                        'razonsocial'           => !is_null($dato['razonsocial'])?$dato['razonsocial']:"",
                        'direccion'             => !is_null($dato['direccion'])?$dato['direccion']:"",
                        'telefono'              => !is_null($dato['telefono'])?$dato['telefono']:"",
                        'email'                 => !is_null($dato['emailf'])?$dato['emailf']:"",
                        'codigo'                => !is_null($dato['codigo'])?$dato['codigo']:"",
                        'empresa'               => !is_null($dato['empresa'])?$dato['empresa']:"",
                        'dv'                    => !is_null($dato['dv'])?$dato['dv']:"",
                        'barrio'                => !is_null($dato['barrio'])?$dato['barrio']:"",
                        'segmento'              => !is_null($dato['segmento'])?$dato['segmento']:"",
                        'rutadeventa'           => !is_null($dato['ruta'])?$dato['ruta']:"",
                        'zonadeventa'           => !is_null($dato['zona'])?$dato['zona']:"",
                        'tipodecliente'         => !is_null($dato['tipocliente'])?$dato['tipocliente']:"",
                        'lista'                 => !is_null($dato['lista'])?$dato['lista']:"",
                        'vendedor'              => !is_null($dato['vendedor'])?$dato['vendedor']:"",
                        'ciudad'                => !is_null($dato['ciudad'])?$dato['ciudad']:"",
                        'categoria01'           => "",
                        'categoria02'           => "",
                        'matriculamercantil'    => !is_null($dato['matriculamercantil'])?$dato['matriculamercantil']:"",
                        'obligacionesfiscales'  => !is_null($dato['rutobligaciones'])?$dato['rutobligaciones']:"",
                        'tipoderegimen'         => !is_null($dato['ruttiporegimen'])?$dato['ruttiporegimen']:0,
                        'zonapostal'            => !is_null($dato['zonapostal'])?$dato['zonapostal']:"",
                        'contacto'              => !is_null($dato['contacto'])?$dato['contacto']:"",
                        'fechadenacimiento'     => !is_null($dato['fechacumpleano'])?$dato['fechacumpleano']:"0001-01-01",
                        'local'                 => !is_null($dato['localf'])?$dato['localf']:"",
                        'codigoprestador'       => !is_null($dato['codigoprestador'])?$dato['codigoprestador']:"",
                        'fechaultimopago'       => !is_null($dato['fechaultimopago'])?$dato['fechaultimopago']:"0001-01-01",
                        'fechaultimacompra'     => !is_null($dato['fechaultimacompra'])?$dato['fechaultimacompra']:"0001-01-01",
                        'fechadecreacion'       => !is_null($dato['fechadecreacion'])?$dato['fechadecreacion']:"0001-01-01",
                        'fechafinaldecontrato'  => !is_null($dato['fechadefinaldecontrato'])?$dato['fechadefinaldecontrato']:"0001-01-01",
                        'rutafoto'              => !is_null($dato['rutafoto'])?$dato['rutafoto']:"",
                        'rutafirma'             => !is_null($dato['rutafirma'])?$dato['rutafirma']:"",
                        'numerodecontrato'      => !is_null($dato['numerodecontrato'])?$dato['numerodecontrato']:"",
                        'propiedad'             => !is_null($dato['propiedad'])?$dato['propiedad']:"",
                        'tipodepropiedad'       => !is_null($dato['tipopropiedad'])?$dato['tipopropiedad']:0,
                        'tipodearrendatario'    => !is_null($dato['tipoarrendatario'])?$dato['tipoarrendatario']:0,
                        'ivapropietario'        => !is_null($dato['ivapropietario'])?$dato['ivapropietario']:0,
                        'porcentajedeincremento' => !is_null($dato['porcentajedeincremento'])?$dato['porcentajedeincremento']:0,
                        'tipoclienteinmobiliaria' => !is_null($dato['tipoclienteinmobiliaria'])?$dato['tipoclienteinmobiliaria']:0,
                        'idlocal'               => !is_null($dato['localf'])?$dato['localf']:"",
                        'ocupacion'             => !is_null($dato['ocupacion'])?$dato['ocupacion']:"",
                        'nacionalidad'          => !is_null($dato['nacionalidad'])?$dato['nacionalidad']:"",
                        'observaciones'         => !is_null($dato['observaciones'])?$dato['observaciones']:"",
                        'proyecto'              => !is_null($dato['proyecto'])?$dato['proyecto']:"",
                        'sproyecto'             => "",
                        'centrooper'            => !is_null($dato['centrooper'])?$dato['centrooper']:"",
                        'direcciondeentrega'    => "",
                        'telefonodeentrega'     => "",
                        'ciudaddeentrega'       => "",
                        'contactodeentrega'     => "",
                        'cuenta'                => "",
                        'centro'                => "",
                        'scentro'               => "",
                        'latitud'               => 0,
                        'longitud'              => 0,
                        'estado'                => $dato['estado'],
                        'estado1'               => 1,
                        'segmento'              => !is_null($dato['segmento'])?$dato['segmento']:"",
                        'actividadeconomica'    => !is_null($dato['actividadeconomica'])?$dato['actividadeconomica']:"",
                        'regimenfiscal'         => !is_null($dato['ruttiporegimen'])?$dato['ruttiporegimen']:"",
                        'canon'                 => $dato['canon'],
                        'administracion'        => $dato['administracion'],
                        'porcentaje'            => $dato['porcentaje'],
                        'iva'                   => $dato['iva'],
                        'cupodecartera'         => !is_null($dato['cupocartera'])?$dato['cupocartera']:0,
                        'plazodecartera'        => !is_null($dato['diasplazo'])?$dato['diasplazo']:0,
                        'declararenta'          => !is_null($dato['tipodeclarante'])?$dato['tipodeclarante']:0,
                        'diascontrol'           => 0,
                        'puntos'                => $dato['canon'],
                        'manejapuntos'          => $dato['tipopropiedad'],
                        'puntosacumulados'      => $dato['administracion'],
                        'retencionautomatica'   => $dato['retencionesautomaticas'],
                        'usuario_created'       => is_null($dato['usuariocreated'])?"":$dato['usuariocreated'],
                        'usuario_updated'       => is_null($dato['usuarioupdated'])?"":$dato['usuarioupdated'],
                    ]);
                } catch (\Exception $ex) {
                    return response()->json(
                        [
                        'status'   => '404 OK',
                        'msg'      => 'Error Clientes',
                        'error' => $ex,
                        ],Response::HTTP_BAD_REQUEST);    
                } 

                }
            }
        }

       $contador = 0;
       if (isset($request->detalle))
       {
            $detalles         = $request->detalle;
            $xcuantos         = count($detalles);
            $contador = 0;
            $fechadesde = "";
            $fechahasta = "";

            foreach ($detalles as $detalle)
            {
                
                $fechadesde     =  $contador==0?$detalle['fechafactura']:$fechadesde;
                $fechahasta     = $detalle['fechafactura'];
                $contador++;
                $numerofactura  = $detalle['numerofactura'];
                $prefijo        = !is_null($detalle['prefijo'])?$detalle['prefijo']:"";
                $tipodcto       = !is_null($detalle['tipodocumento'])?$detalle['tipodocumento']:"";
                $nit            = !is_null($detalle['nit'])?$detalle['nit']:"";
                $producto       = !is_null($detalle['producto'])?$detalle['producto']:"";
                $bodega         = !is_null($detalle['bodega'])?$detalle['bodega']:"";
                $idregistro     = !is_null($detalle['idregistro'])?$detalle['idregistro']:"";
                $cantidad1      = $detalle['peso']>0?$detalle['peso']:0;
                $cantidad1      = $detalle['unidades']>0?$detalle['unidades']:$cantidad1;
                $idlocal        = $detalle['idlocal'];
                
                detalledefactura::updateOrCreate(['numerodefactura'=>$numerofactura,'tipodedocumento'=>$tipodcto, 'prefijo'=>$prefijo, 'nit' => $nit,'producto' => $producto,'bodega'=>$bodega,'idlocal'=>$idlocal],
                [
                    //'numerofactura'         => $detalle['numerofactura'],
                    //'prefijo'               => !is_null($detalle['prefijo'])?$detalle['prefijo']:""
                    //'tipodedocumento'       => $detalle['tipodocumento'],
                    //'nit'                   => $detalle['nit'],
                    'sucursal'              => !is_null($detalle['sucursal'])?$detalle['sucursal']:"",
                    'fechadefactura'        => $detalle['fechafactura'],
                    'fechadevencimiento'    => $detalle['vencimiento'],
                    'tipodemovimiento'      => is_null($detalle['tipomvto'])?"":$detalle['tipomvto'],
                    //'producto'              => $detalle['producto'],
                    'descripcion'            => is_null($detalle['descripcion'])?"":$detalle['descripcion'],
                    'producto2'             => is_null($detalle['codigoterminado'])?"":$detalle['codigoterminado'],
                    //'bodega'                => $detalle['bodega'],
                    'lote'                  => is_null($detalle['lote'])?"":$detalle['lote'],
                    'cantidad'              => $detalle['cantidad'],
                    'cantidad1'             => $cantidad1,
                    'valorventa'            => $detalle['valor'],
                    'costopromedio'         => $detalle['costopromedio'],
                    'porcentajeiva'         => $detalle['ivaproducto'],
                    'descuento1'            => $detalle['descuento1'],
                    'descuento2'            => $detalle['descuento2'],
                    'descuento3'            => $detalle['descuento3'],
                    'valordescuento1'       => $detalle['vdescuento1'],
                    'valordescuento2'       => $detalle['vdescuento2'],
                    'valordescuento3'       => $detalle['vdescuento3'],
                    'idregistro'            => $detalle['idregistro'],
                    'impoconsumo'           => $detalle['impoconsumo'],
                    'concepto'              => $detalle['concepto'],
                    'cptoclase'             => $detalle['cptoclase'],
                    'serial'                => is_null($detalle['serial'])?"":$detalle['serial'],
                    'garantia'              => is_null($detalle['garantia'])?"":$detalle['garantia'],
                    'tipodecliente'         => is_null($detalle['tipocliente'])?"":$detalle['tipocliente'],
                    'rutadeventa'           => is_null($detalle['ruta'])?"":$detalle['ruta'],
                    'zonadeventa'           => is_null($detalle['zona'])?"":$detalle['zona'],
                    'centrooper'            => is_null($detalle['centrooper'])?"":$detalle['centrooper'],
                    'proyecto'              => is_null($detalle['proyecto'])?"":$detalle['proyecto'],
                    'sproyecto'             => is_null($detalle['sproyecto'])?"":$detalle['sproyecto'],
                    'cuenta'                => is_null($detalle['cuenta'])?"":$detalle['cuenta'],
                    'centro'                => is_null($detalle['centro'])?"":$detalle['centro'],
                    'scentro'               => is_null($detalle['scentro'])?"":$detalle['scentro'],
                    'vendedor'              => is_null($detalle['vendedor'])?"":$detalle['vendedor'],
                    'tecnico'               => is_null($detalle['vendedor'])?"":$detalle['vendedor'],
                    'propiedad'             => "",
                    'vehiculo'              => is_null($detalle['placa'])?"":$detalle['placa'],
                    'estado'                => is_null($detalle['estado'])?0:$detalle['estado'],
                    'estado01'              => is_null($detalle['estado01'])?0:$detalle['estado01'],
                    'estado02'              => is_null($detalle['estado02'])?0:$detalle['estado02'],
                    'estado03'              => is_null($detalle['estado03'])?0:$detalle['estado03'],
                    'usuario_created'       => is_null($detalle['usuariocreated'])?"":$detalle['usuariocreated'],
                    'usuario_updated'       => is_null($detalle['usuarioupdated'])?"":$detalle['usuarioupdated'],
                ]);
         
                // return response()->json(
                //     [
                //     'status'   => '200OK',
                //     'msg'      => 'Salida Pre Exitosa',
                //     'msg2'      => $contador,
                //     ],Response::HTTP_ACCEPTED);
                //}
            }
        }

        $contador = 0;
        if (isset($request->detremision))
        {
             $detalles         = $request->detremision;
             $xcuantos         = count($detalles);
             $contador = 0;
             $fechadesde = "";
             $fechahasta = "";

             foreach ($detalles as $detalle)
             {
                 $fechadcto      = $detalle['fechaderemision'];
                 $contador++;
                 $consecutivo    = $detalle['consecutivo'];
                 $tipodcto       = !is_null($detalle['tipodocumento'])?$detalle['tipodocumento']:"";
                 $nit            = !is_null($detalle['nit'])?$detalle['nit']:"";
                 $producto       = !is_null($detalle['producto'])?$detalle['producto']:"";
                 $bodega         = !is_null($detalle['bodega'])?$detalle['bodega']:"";
                 $idregistro     = !is_null($detalle['idregistro'])?$detalle['idregistro']:0;
                 $cantidad1      = $detalle['peso']>0?$detalle['peso']:0;
                 $cantidad1      = $detalle['unidades']>0?$detalle['unidades']:$cantidad1;

                 detallederemision::updateOrCreate(['consecutivo'=>$consecutivo,'tipodedocumento'=>$tipodcto,'fechadocumento'=>$fechadcto, 'producto' => $producto,'bodega'=>$bodega,'idregistro'=>$idregistro],
                 [
                     //'numerofactura'         => $detalle['numerofactura'],
                     //'prefijo'               => !is_null($detalle['prefijo'])?$detalle['prefijo']:""
                     'lapso'                 => $detalle['lapso'],
                     'nit'                   => $nit,
                     'sucursal'              => !is_null($detalle['sucursal'])?$detalle['sucursal']:"",
                     'fechadevencimiento'    => $fechadcto,
                     //'tipodemovimiento'      => is_null($detalle['tipomvto'])?"":$detalle['tipomvto'],
                     //'producto'              => $detalle['producto'],
                     'descripcion'           => is_null($detalle['descripcion'])?"":$detalle['descripcion'],
                     'producto2'             => "",
                     //'bodega'                => $detalle['bodega'],
                     'lote'                  => is_null($detalle['lote'])?"":$detalle['lote'],
                     'cantidad'              => $detalle['cantidad'],
                     'cantidad1'             => $cantidad1,
                     'valor'                 => $detalle['valor'],
                     'costopromedio'         => $detalle['costopromedio'],
                     'ivaproducto'           => $detalle['ivaproducto'],
                     'descuento1'            => $detalle['descuento1'],
                     'descuento2'            => $detalle['descuento2'],
                     'descuento3'            => $detalle['descuento3'],
                     'valordescuento1'       => $detalle['vdescuento1'],
                     'valordescuento2'       => $detalle['vdescuento2'],
                     'valordescuento3'       => $detalle['vdescuento3'],
                     'idregistro'            => $detalle['idregistro'],
                     'tipodemovimiento'      => 1,
                     'impoconsumo'           => $detalle['impoconsumo'],
                     'concepto'              => is_null($detalle['conceptoinv'])?"":$detalle['conceptoinv'],
                     'cptoclase'             => is_null($detalle['cptoclase'])?"":$detalle['cptoclase'],
                     'serial'                => is_null($detalle['serial'])?"":$detalle['serial'],
                     'garantia'              => is_null($detalle['garantia'])?"":$detalle['garantia'],
                     'tipodecliente'         => is_null($detalle['tipocliente'])?"":$detalle['tipocliente'],
                     'rutadeventa'           => is_null($detalle['ruta'])?"":$detalle['ruta'],
                     'zonadeventa'           => is_null($detalle['zona'])?"":$detalle['zona'],
                     'centrooper'            => is_null($detalle['centrooper'])?"":$detalle['centrooper'],
                     'proyecto'              => is_null($detalle['proyecto'])?"":$detalle['proyecto'],
                     'sproyecto'             => is_null($detalle['sproyecto'])?"":$detalle['sproyecto'],
                     'cuenta'                => "",
                     'centro'                => "",
                     'scentro'               => "",
                     'propiedad'             => "",
                     'vendedor'              => is_null($detalle['vendedor'])?"":$detalle['vendedor'],
                     'tecnico'               => is_null($detalle['vendedor'])?"":$detalle['vendedor'],
                     'placa'                 => is_null($detalle['vehiculo'])?"":$detalle['vehiculo'],
                     'estado'                => is_null($detalle['estado'])?0:$detalle['estado'],
                     'estado01'              => is_null($detalle['estado01'])?0:$detalle['estado01'],
                     'estado02'              => is_null($detalle['estado02'])?0:$detalle['estado02'],
                     'estado03'              => is_null($detalle['estado03'])?0:$detalle['estado03'],
                     'usuario_updated'       => is_null($detalle['usuarioupdated'])?"":$detalle['usuarioupdated'],
                 ]);       
             }
         }


        $contador = 0;
        if (isset($request->facturas))
        {
            $facturas        = $request->facturas;
            $xcuantos         = count($facturas);

            foreach ($facturas as $factura)
            {
                $contador++;
                $numerofactura  = $factura['numerofactura'];
                $prefijo        = !is_Null($factura['prefijo'])?$factura['prefijo']:"";
                $tipodcto       = !is_Null($factura['tipodocumento'])?$factura['tipodocumento']:"";
                $fechafac       = $factura['fechafactura'];
                $nit            = !is_Null($factura['nit'])?$factura['nit']:"";
                $sucursal       = !is_Null($factura['sucursal'])?$factura['sucursal']:"";

                $clientes       = cliente::where('nit',$nit)->where('sucursal',$sucursal)->first();
                $clientesID     = is_object($clientes)?$clientes->clientesID:1;
                try
                {
                    $reg_fact       = factura::updateOrCreate(['numerodefactura'=>$numerofactura, 'prefijo'=>$prefijo, 'tipodedocumento' => $tipodcto,'fechafactura' => $fechafac],
                    [
                            //$regfacturas = new factura;
                        //'numerodefactura'      => $factura['numerofactura'] ,
                        //'tipodedocumento'      => $factura['tipodocumento'] ,
                        //'prefijo'              => $factura['prefijo'],
                        'fechafactura'         => $factura['fechafactura'],
                        'horashabitacion'      => $factura['nrodehoras'],
                        'fechavencimiento'     => $factura['vencimiento'],
                        'cufe'                 => is_Null($factura['cufe'])?"":$factura['cufe'],
                        'habitacion'           => is_null($factura['habitacion'])?"":$factura['habitacion'],
                        'fechadeentrada'       => $factura['fechaentrada'],
                        'fechadesalida'        => $factura['fechasalida'],
                        'lapso'                => $factura['lapso'],
                        'numerodepedido'       => $factura['npedido'],
                        'numerodecompra'       => $factura['nocompra'],
                        'nit'                  => $factura['nit'],
                        'sucursal'             => $factura['sucursal'],
                        'nombreventa'          => is_null($factura['nombreventa'])?"":$factura['nombreventa'],
                        'paciente'             => is_null($factura['paciente'])?"":$factura['paciente'],
                        'propina'              => $factura['propina'],
                        'valorfactura'         => $factura['valorfactura'],
                        'descuentosproductos'  => $factura['dsctosprod'],
                        'descuentosadicionales'=> $factura['dsctosadic'],
                        'ventasexentas'        => $factura['ventasexen'],
                        'ventagravadas'        => $factura['ventasgrav'],
                        'valoradicional'       => $factura['valoradicional'],
                        'flete'                => $factura['flete'],
                        'retefuente'           => $factura['retencion'],
                        'reteiva'              => $factura['reteiva'],
                        'valoriva'             => $factura['valoriva'],
                        'reteica'              => $factura['reteica'],
                        'otrasret1'            => $factura['otrasret1'],
                        'otrasret2'            => $factura['otrasret2'],
                        'otrasret3'            => $factura['otrasret3'],
                        'otrasret4'            => $factura['otrasret4'],
                        'otrasret5'            => $factura['otrasret5'],
                        'valordescuento1'      => 0,
                        'valordescuento2'      => 0,
                        'valordescuento3'      => 0,
                        'numerodecompra'       => 0,
                        'numeroderegistros'    => $factura['numregistros'],
                        'totalfactura'         => $factura['totalfactura'],
                        'costodeventa'         => $factura['costodeventa'],
                        'tipodefactura'        => $factura['tipofactura'],
                        'centrooper'           => is_null($factura['centrooper'])?"":$factura['centrooper'],
                        'proyecto'             => is_null($factura['proyecto'])?"":$factura['proyecto'],
                        'sproyecto'            => is_null($factura['sproyecto'])?"":$factura['sproyecto'],
                        'estado'               => $factura['estado'],
                        'estado01'             => $factura['estado01'],
                        'estado02'             => $factura['estado02'],
                        'estado03'             => $factura['estado03'],
                        'usuario_created'      => is_null($factura['usuariocreated'])?"":$factura['usuariocreated'],
                        'usuario_updated'      => is_null($factura['usuarioupdated'])?"":$factura['usuarioupdated'],
                        //-- Actualizar Campos obligatorios
                        'clientesid'            => $clientesID,
                        'vendedorid'            => 1,
                        'horadefactura'         => $factura['horafactura'],
                        'cuenta'                => is_null($factura['cuenta'])?"":$factura['cuenta'],
                        'centro'                => is_null($factura['centro'])?"":$factura['centro'],
                        'scentro'               => is_null($factura['scentro'])?"":$factura['scentro'],
                        'actividad'             => is_null($factura['actividad'])?"":$factura['actividad'],
                        'observaciones'         => is_null($factura['observaciones'])?"":$factura['observaciones'],
                        'nitarrendatario'       => is_null($factura['nitarrendat'])?"":$factura['nitarrendat'],
                        'sucursalarrendatario'  => is_null($factura['sucarrendat'])?"":$factura['sucarrendat'],
                        'propiedad'             => is_null($factura['propiedad'])?"":$factura['propiedad'],
                        'contrato'              => "",
                        'caja'                  => is_null($factura['caja'])?"":$factura['caja'],
                        'cajero'                => is_null($factura['cajero'])?"":$factura['cajero'],
                        'mesa'                  => is_null($factura['mesa'])?"":$factura['mesa'],
                        'mesero'                => is_null($factura['mesero'])?"":$factura['mesero'],
                        'conceptodeinterface'   => "",
                        'lista'                 => $factura['lista'],
                        'plan'                  => is_null($factura['planf'])?"":$factura['planf'],
                        'transportador'         => is_null($factura['transportador'])?"":$factura['transportador'],
                        'placa'                 => is_null($factura['placa'])?"":$factura['placa'],
                        'tipodepago'            => is_null($factura['tipodepago'])?"":$factura['tipodepago'],
                        'numerodedocumento'     => is_null($factura['numerodocumento'])?"":$factura['numerodocumento'],
                        'valordelpago'          => is_null($factura['valordelpago'])?"":$factura['valordelpago'],
                        'valorotrodocumento'    => is_null($factura['valordelpago'])?"":$factura['valordelpago'],
                        'documentodian'         => is_null($factura['valorotrodcto'])?"":$factura['valorotrodcto'],
                        'tecnico'               => is_null($factura['vendedor'])?"":$factura['vendedor'],
                        'profesional'           => "",
                        'codigodedescuento'     => is_null($factura['codigodctos'])?"":$factura['codigodctos'],
                        'tipodecliente'         => is_null($factura['tipocliente'])?"":$factura['tipocliente'],
                        'rutadeventa'           => is_null($factura['ruta'])?"":$factura['ruta'],
                        'zonadeventa'           => is_null($factura['zona'])?"":$factura['zona'],
                        'vendedor'              => is_null($factura['vendedor'])?"":$factura['vendedor'],
                        'kilometraje'           => is_null($factura['kilometraje'])?0:$factura['kilometraje'],
                        'numerodelreparto'      => is_null($factura['nreparto'])?0:$factura['nreparto'],
                        'montodelrecaudo'       => is_null($factura['recaudosrepartos'])?0:$factura['recaudosrepartos'],
                        'saldoencartera '       => is_null($factura['saldocartera'])?0:$factura['saldocartera'],
                    ]);
                } catch (\Exception $ex) {
                    return response()->json(
                        [
                        'status'   => '404 OK',
                        'msg'      => 'Error Dcto Invt',
                        'error' => $ex,
                        ],Response::HTTP_BAD_REQUEST);    
                } 

                $numerofactura  = $factura['numerofactura'];
                $prefijo        = $factura['prefijo'];
                $tipodcto       = $factura['tipodocumento'];
                $facturasID     = $reg_fact->FacturasID;
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                detalledefactura::where('detalledefacturas.numerodefactura',"=",$numerofactura)
                ->where('detalledefacturas.tipodedocumento',"=",$tipodcto)
                ->where('detalledefacturas.prefijo',"=",$prefijo)
                ->update(['detalledefacturas.FacturasID' => $facturasID, 'detalledefacturas.ClientesID' => $clientesID]);
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            }
       }

       $contador = 0;
       if (isset($request->remision))
       {
           $remisiones        = $request->remision;
           foreach ($remisiones as $remision)
           {
                $contador++;
                $consecutivo    = $remision['consecutivo'];
                $tipodcto       = !is_null($remision['tipodocumento'])?$remision['tipodocumento']:"";
                $fechadcto      = $remision['fechaderemision'];
                $centrooper     = !is_null($remision['centrooper'])?$remision['centrooper']:"";

                $nit            = !is_Null($remision['nit'])?$remision['nit']:"";
                $sucursal       = !is_Null($remision['sucursal'])?$remision['sucursal']:"";

                $clientes       = cliente::where('nit',$nit)->where('sucursal',$sucursal)->first();
                $clientesID     = is_object($clientes)?$clientes->clientesID:1;

                $reg_rem       = remision::updateOrCreate(['consecutivo'=>$consecutivo, 'tipodedocumento'=>$tipodcto, 'fechadocumento' => $fechadcto ,'centrooper' => $centrooper],
                [
                     'lapso'                => $remision['lapso'],
                     'nit'                  => !is_null($remision['nit'])?$remision['nit']:"",
                     'sucursal'             => !is_null($remision['sucursal'])?$remision['sucursal']:"",
                     'nombreventa'          => !is_null($remision['nombreventa'])?$remision['nombreventa']:"",
                     'horadocumento'        => !is_null($remision['horadocumento'])?$remision['horadocumento']:"",
                     'npedido'              => $remision['npedido'],
                     'proyecto'             => !is_null($remision['proyecto'])?$remision['proyecto']:"",
                     'sproyecto'            => !is_null($remision['sproyecto'])?$remision['sproyecto']:"",
                     'actividad'            => !is_null($remision['actividad'])?$remision['actividad']:"",
                     'valor'                => $remision['valor'],
                     'valoriva'             => $remision['valoriva'],
                     'dsctosadicionales'    => $remision['dsctosadicionales'],
                     'dsctosproductos'      => $remision['dsctosproductos'],
                     'valoradicional'       => $remision['valoradicional'],
                     'costodeventa'         => $remision['costodeventa'],
                     'valorotrodocumento'   => $remision['valorotrodocumento'],
                     'valordepago'          => $remision['valordelpago'],
                     'impoconsumo'          => $remision['impuestoconsumo'],
                     'impuestoica'          => $remision['impuestoica'],
                     'flete'                => $remision['flete'],
                     'totaldocumento'       => $remision['totaldocumento'],
                     'listadeprecio'        => !is_null($remision['lista'])?$remision['lista']:"",
                     'rutadeventa'          => !is_null($remision['ruta'])?$remision['ruta']:"",
                     'zonadeventa'          => !is_null($remision['zona'])?$remision['zona']:"",
                     'vendedor'             => !is_null($remision['vendedor'])?$remision['vendedor']:"",
                     'tipodecliente'        => !is_null($remision['tipocliente'])?$remision['tipocliente']:"",
                     'caja'                 => "",
                     'cajero'               => "",
                     'mesa'                 => "",
                     'mesero'               => "",
                     'observaciones'        => !is_null($remision['observaciones'])?$remision['observaciones']:"",
                     'placa'                => !is_null($remision['vehiculo'])?$remision['vehiculo']:"",
                     'transportador'        => !is_null($remision['transportador'])?$remision['transportador']:"",
                     'tipoderemision'       => $remision['tipoderemision'],
                     'kilometraje'          => $remision['kilometraje'],
                     'estado'               => $remision['estado'],
                     'estado01'             => $remision['estado01'],
                     'estado02'             => $remision['estado02'],
                     'estado03'             => $remision['estado03'],
                     'usuario_created'      => is_null($remision['usuariocreated'])?"":$remision['usuariocreated'],
                     'usuario_updated'      => is_null($remision['usuarioupdated'])?"":$remision['usuarioupdated'],
                ]);
                $consecutivo    = $remision['consecutivo'];
                $fechadcto      = $remision['fechaderemision'];
                $tipodcto       = $remision['tipodocumento'];
                $centrooper     = !is_null($remision['centrooper'])?$remision['centrooper']:"";
                $RemisionID     = $reg_rem->RemisionID;
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                detallederemision::where('detallederemision.consecutivo',"=",$consecutivo)
                ->where('detallederemision.fechadocumento',"=",$fechadcto)
                ->where('detallederemision.tipodedocumento',"=",$tipodcto)
                ->where('detallederemision.centrooper',"=",$centrooper)
                ->update(['detallederemision.RemisionID' => $RemisionID, 'detallederemision.ClientesID' => $clientesID]);
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
           }

       }

       $contador = 0;
       if (isset($request->dctosinv))
       {

        $documentos     = $request->dctosinv;
        foreach ($documentos as $documento)
        {            
            $contador++;
            $consecutivo    = $documento['consecutivo'];
            $concepto       = $documento['concepto'];
            $cptoclase      = $documento['cptoclase'];
            $nit            = $documento['nit'];
            $sucursal       = $documento['sucursal'];
            $fecha          = $documento['fecha'];
            $orden          = strval($documento['nrodeorden']);
            $totaldcto      = $documento['valordcto'] + $documento['valoriva'] + $documento['valoradicional'] - $documento['valordescuento']
                              - $documento['valordescuentoadicional'] - $documento['valorrtefte'] - $documento['valorrteiva'] - $documento['valorrteica'];
            
           
            documentosdeinventario::updateOrCreate(['consecutivo'=>$consecutivo, 'concepto'=>$concepto,
                              'cptoclase' => $cptoclase,'nit' => $nit,'sucursal'=>$sucursal,'fechademovimiento'=>$fecha],
            [
                'nit'                       => $documento['nit'],
                'sucursal'                  => $documento['sucursal'],
                'facturadecompra'           => $documento['nrodefactura'],
                'prefijo'                   => is_null($documento['prefijo'])?"":$documento['prefijo'],
                'ordendecompra'             => is_null($orden)?"":$orden,
                'documentodecompra'         => is_null($documento['dctofactura'])?"":$documento['dctofactura'],
                'fechadefactura'            => $documento['fechadefactura'],
                'fechadevencimiento'        => $documento['fechadevencimiento'],
                'valordocumento'            => $documento['valordcto'],
                'descuentoproductos'        => $documento['valordescuento'],
                'descuentoadicional'        => $documento['valordescuentoadicional'],
                'valoriva'                  => $documento['valoriva'],
                'valoradicional'            => $documento['valoradicional'],
                'retefuente'                => $documento['valorrtefte'],
                'reteiva'                   => $documento['valorrteiva'],
                'reteica'                   => $documento['valorrteica'],
                'otrasret1'                 => $documento['otrasretenciones1'],
                'otrasret2'                 => $documento['otrasretenciones2'],
                'otrasret3'                 => $documento['otrasretenciones3'],
                'otrasret4'                 => $documento['otrasretenciones4'],
                'otrasret5'                 => $documento['otrasretenciones5'],
                'totaldocumento'            => $totaldcto,
                'placa'                     => is_null($documento['placa']) ? "" : $documento['placa'],
                'centrooper'                => is_null($documento['centrooper'])? '' : $documento['centrooper'],
                'proyecto'                  => is_null($documento['proyecto']) ? "" : $documento['proyecto'],
                'sproyecto'                 => is_null($documento['sproyecto']) ? "" : $documento['sproyecto'],
                'actividad'                 => is_null($documento['actividad'])? '' : $documento['actividad'],
                'centro'                    => is_null($documento['centro'])? '' : $documento['centro'],
                'scentro'                   => is_null($documento['scentro'])? '' : $documento['scentro'],
                'lapso'                     => $documento['lapso'],
                'tipodemovimiento'          => $documento['tipodemovimiento'],
                'tipodecompra'              => $documento['tipodecompra'],
                'conceptotraslado'          => is_null($documento['cptoinvtr'])?"":$documento['cptoinvtr'],
                'cptoclasetraslado'         => is_null($documento['cptoclasetr'])?"":$documento['cptoclasetr'],
                'bodegatraslado'            => is_null($documento['bodegatr'])?"":$documento['bodegatr'],
                'lotetraslado'              => is_null($documento['lotetr'])?"":$documento['lotetr'],
                'estado'                    => $documento['estado'],
                'estado01'                  => $documento['estado01'],
                'estado02'                  => $documento['estado02'],
                'estado03'                  => $documento['estado03'],
                'ivaasumido'                => $documento['ivaasumido'],
                'observaciones'             => is_null($documento['observaciones'])?"":$documento['observaciones'],
                'msgevento1'                => is_null($documento['msgevento1'])?"":$documento['msgevento1'],
                'msgevento2'                => is_null($documento['msgevento2'])?"":$documento['msgevento2'],
                'msgevento3'                => is_null($documento['msgevento3'])?"":$documento['msgevento3'],
                'fechaevento1'              => $documento['fechaevento1'],
                'fechaevento2'              => $documento['fechaevento2'],
                'fechaevento3'              => $documento['fechaevento3'],
                'cufe'                      => is_null($documento['cufe'])?"":$documento['cufe'],
                'codstatus'                 => is_null($documento['codstatus'])?"":$documento['codstatus'],
                'copdestino'                => is_null($documento['copdestino'])?"":$documento['copdestino'],
                'usuario_created'           => is_null($documento['usuariocreated'])?"":$documento['usuariocreated'],
                'usuario_updated'           => is_null($documento['usuarioupdated'])?"":$documento['usuarioupdated'],
            ]);     

        }
       }

       $contador = 0;
       if (isset($request->detinventario))
       {
           $detalles = $request->detinventario;
           foreach ($detalles as $detalle)
           {
               $fechamvto       = $detalle['fechamvto'];
               $idregistro      = $detalle['idregistro'];
               $consecutivo     = $detalle['cnsnumero'];
               $concepto        = $detalle['concepto'];
               $tipodocumento   = $detalle['tipodocumento'];
               $producto        = $detalle['producto'];
               $bodega          = $detalle['bodega'];
               $idregistro      = $detalle['idregistro'];
               $nit             = $detalle['nit'];
               $cantidad1       = $detalle['peso']>0?$detalle['peso']:0;
               $cantidad1       = $detalle['unidad']>0?$detalle['unidad']:$cantidad1;
               if (strlen($producto) != 0)
               {
                 $reg_fact        = movimientosdeinventario::updateOrCreate(['fechamovimiento'=>$fechamvto, 'consecutivo'=>$consecutivo, 'tipodedocumento' => $tipodocumento,
                                 'concepto' => $concepto,'nit' => $nit, 'producto'=>$producto,'bodega'=>$bodega,'idregistro'=>$idregistro],
                    [
                        'fechamovimiento'       => $fechamvto,
                        'consecutivo'           => $consecutivo,
                        'tipodedocumento'       => !is_null($tipodocumento)?$tipodocumento:"",
                        'nit'                   => $nit,
                        'sucursal'              => !is_null($detalle['sucursal'])?$detalle['sucursal']:"",
                        'nit2'                  => !is_null($detalle['nit2'])?$detalle['nit2']:"",
                        'sucursal2'             => !is_null($detalle['sucursal2'])?$detalle['sucursal2']:"",
                        'concepto'              => $detalle['concepto'],
                        'cptoclase'             => $detalle['cptoclase'],
                        'lapso'                 => $detalle['lapso'],
                        'facturadecompra'       => 0,
                        'iddocumento'           => $detalle['documento'],
                        'prefijo'               => !is_null($detalle['prefijo'])?$detalle['prefijo']:"",
                        'placa'                 => !is_null($detalle['vehiculo'])?$detalle['vehiculo']:"",
                        'producto'              => !is_null($detalle['producto'])?$detalle['producto']:"",
                        'bodega'                => !is_null($detalle['bodega'])?$detalle['bodega']:"",
                        'lote'                  => !is_null($detalle['lote'])?$detalle['lote']:"",
                        'descripcion'           => $detalle['nombre'],
                        'ordendecompra'         => $detalle['ordent'],
                        'cuenta'                => !is_null($detalle['cuenta'])?$detalle['cuenta']:"",
                        'centro'                => !is_null($detalle['centro'])?$detalle['centro']:"",
                        'scentro'               => !is_null($detalle['scentro'])?$detalle['scentro']:"",
                        'centrooper'            => !is_null($detalle['centrooper'])?$detalle['centrooper']:"",
                        'actividad'             => !is_null($detalle['actividad'])?$detalle['actividad']:"",
                        'tipodemovimiento'      => $detalle['tipomov'],
                        'cantidad'              => $detalle['cantidad'],
                        'cantidad1'             => $cantidad1,
                        'valor'                 => $detalle['valor'],
                        'valorventa'            => $detalle['valorventa'],
                        'costoreal'             => $detalle['costoreal'],
                        'valornetorealizable'   => $detalle['valornetorealizable'],
                        'descuento1'            => $detalle['descuento1'],
                        'descuento2'            => $detalle['descuento2'],
                        'descuento3'            => $detalle['descuento3'],
                        'ivaproducto'           => $detalle['iva'],
                        'lotemedicamento'       => !is_null($detalle['lotemedicamento'])?$detalle['lotemedicamento']:"",
                        'fechadevencimiento'    => $detalle['fechavencimiento'],
                        'impoconsumo'           => $detalle['impoconsumo'],
                        'estado'                => $detalle['estado'],
                        'estado01'              => $detalle['estado01'],
                        'estado02'              => $detalle['estado02'],
                        'estado03'              => $detalle['estado03'],
                        'idregistro'            => $detalle['idregistro'],
                        'usuario_created'       => is_null($detalle['usuariocreated'])?"":$detalle['usuariocreated'],
                        'usuario_updated'       => is_null($detalle['usuarioupdated'])?"":$detalle['usuarioupdated'],
                    ]);
               }
           }
       }

       $contador = 0;
       if (isset($request->saldos))
       {
           $saldos      = $request->saldos;
           $fecha       = Carbon::now();
           $ano         = $fecha->format('Y');
           foreach ($saldos as $dato)
           {
              $producto         = $dato['codigo'];
              $bodega           = !is_null($dato['bodega'])?$dato['bodega']:"";
              $lote             = !is_null($dato['lote'])?$dato['lote']:"";
              $anoproc          = $ano;
              $regproducto      = producto::where('codigo', $producto)->get()->first();
              $idproducto       = isset($regproducto->productoID)?$regproducto->productoID:0;
              if (strlen($producto) != 0)
              {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                saldosdeinventario::updateOrCreate(['anodeproceso'=>$anoproc, 'producto'=>$producto, 'bodega' => $bodega,
                'lote' => $lote],
                [
                    'cantidad'        => $dato['cantidad'],
                    'cantidad1'       => $dato['cantidad2'],
                    'costopromedio'   => $dato['costopromedio'],
                    'ultimocosto'     => $dato['ultimocosto'],
                    'saldoanterior'   => $dato['saldoanterior'],
                    'saldoanterior1'  => $dato['saldoanterior2'],
                    'costop00'        => $dato['costop00'],
                    'costop01'        => $dato['costop01'],
                    'costop02'        => $dato['costop02'],
                    'costop03'        => $dato['costop03'],
                    'costop04'        => $dato['costop04'],
                    'costop05'        => $dato['costop05'],
                    'costop06'        => $dato['costop06'],
                    'costop07'        => $dato['costop07'],
                    'costop08'        => $dato['costop08'],
                    'costop09'        => $dato['costop09'],
                    'costop10'        => $dato['costop10'],
                    'costop11'        => $dato['costop11'],
                    'costop12'        => $dato['costop12'],
                    'ProductoID'      => $idproducto,
                    'usuario_created'   => is_null($dato['usuariocreated'])?"":$dato['usuariocreated'],
                    'usuario_updated'   => is_null($dato['usuarioupdated'])?"":$dato['usuarioupdated'],
                ]);
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
              }
           }
       }

       $contador = 0;
       if (isset($request->centrooper))
       {
          $centros  = $request->centrooper;

          foreach ($centros as $centro)
          {
            $codigo   = $centro['codigo'];
            centrodeoperacion::updateOrCreate(["codigo" =>$codigo],
            [
               'nombre'           => $centro['descripcion'],
               'direccion'        => "",
               'telefono'         => "",
               'centro'           => "",
               'scentro'          => "",
               'estado'           => $centro['estado'],
               'usuario_created'  => is_null($centro['usuariocreated'])?"":$centro['usuariocreated'],
               'usuario_updated'  => is_null($centro['usuarioupdated'])?"":$centro['usuarioupdated'],
            ]);
          }
       }

       $contador = 0;
       if (isset($request->detlistas))
       {
           $detlistas   = $request->detlistas;
           foreach ($detlistas as $dato)
           {
             $codigo        = !is_null($dato['codigo'])?$dato['codigo']:"";
             $producto      = !is_null($dato['producto'])?$dato['producto']:"";
             $valor         = $dato['valor'];
             $valorunidad   = $dato['valorunidad'];
             $descuento     = $dato['descuento'];

             $curproducto = DB::table('producto')->select('producto.porcentajeiva')
            ->where('producto.codigo','=',$producto)->first();


            $porcentaje = is_null($curproducto)?0:$curproducto->porcentajeiva;

            $valorneto  = round($valor * (1  + ($porcentaje/100)),0);

            detalledelista::updateOrCreate(["codigo" =>$codigo,"producto" =>$producto],
            [
               'valorantesdeiva'  => $dato['valor'],
               'valor'            => $valorneto,
               'valorunidad'      => $valorunidad,
               'valorunifinal'    => $dato['valorotro'],
               'proyecto'         => !is_null($dato['proyecto'])?$dato['proyecto']:"",
               'sproyecto'        => "",
               'centrooper'       => !is_null($dato['centrooper'])?$dato['centrooper']:"",
               'descuento'        => $descuento,
               'iva'              => $porcentaje,
               'usuario_created'  => is_null($dato['usuariocreated'])?"":$dato['usuariocreated'],
               'usuario_updated'  => is_null($dato['usuarioupdated'])?"":$dato['usuarioupdated'],
            ]);
           }
       }

       return response()->json(
        [
         'status'   => '200 OK',
         'msg'      => 'Actualización Exitosa',
        ],Response::HTTP_ACCEPTED);

    }

    public function ConsolidatedSalesCenter(Request $request):JsonResponse
    {
        // return response()->json(
        //     [
        //      'status'       => '200',
        //      'msg'          => 'Ventas Consolidadas por Centros de operaciones'            
        //     ],Response::HTTP_ACCEPTED);

        DB::statement("SET lc_time_names = 'es_Es';");
        $mes  = $request->mes;
        $anop  = $request->año;

        // return response()->json(
        //     [
        //      'status'       => '200',
        //      'msg'          => 'Ventas Consolidadas por Centros de operaciones (' . $anop .')',            
        //     ],Response::HTTP_ACCEPTED);

        $remisiones = remision::select(
            DB::raw('IFNULL(centrooperativo.nombre,"Sin Centro de Operación") as centrodeoperacion'),
            DB::raw("sum(round(totaldocumento,0)) as totalventas"),
            DB::raw("DATE_FORMAT(fechadocumento,'%M %Y') as months"),
            DB::raw("DATE_FORMAT(fechadocumento,'%m') as mes"),
            DB::raw("'REM' as prefijo")        )
            ->leftjoin('centrooperativo', 'remision.centrooper', '=', 'centrooperativo.codigo')
            ->where('remision.estado','=',1)
            ->whereMonth('fechadocumento',$mes)
            ->whereYear('fechadocumento',$anop )
            ->groupBy('centrodeoperacion','months','prefijo');

        $ventas = factura::select(
            DB::raw('IFNULL(centrooperativo.nombre,"Sin Centro de Operación") as centrodeoperacion'),
            DB::raw("sum(round(totalfactura,0)) as totalventas"),
            DB::raw("DATE_FORMAT(fechafactura,'%M %Y') as months"),
            DB::raw("DATE_FORMAT(fechafactura,'%m') as mes"),
            DB::raw("facturas.prefijo as prefijo")        )
            ->leftjoin('centrooperativo', 'facturas.centrooper', '=', 'centrooperativo.codigo')
            ->unionAll($remisiones)
            ->where('facturas.estado','=',1)
            ->whereMonth('fechafactura',$mes)
            ->whereYear('fechafactura',$anop )
            ->groupBy('centrodeoperacion','months','prefijo')
            ->get();

        $ventasjs =$ventas;
        $tot = 0.00;
        foreach($ventas as $dato)
        {
           $tot = $tot + $dato->totalventas;
        }

        return response()->json(
            [
             'status'       => '200',
             'msg'          => 'Ventas Consolidadas por Centros de operaciones (' . $anop .')',
             'grantotal'    =>  $tot,
             'ventas'   => $ventasjs,
            ],Response::HTTP_ACCEPTED);
    }

    public function DailySalesCenter(Request $request):JsonResponse
    {

       
        DB::statement("SET lc_time_names = 'es_Es';");
        $fechad  = $request->fechadesde;
        $fechah  = $request->fechahasta;
        $horad   = $request->horadesde;
        $horah   = $request->horahasta;
        $anop  = $request->año;      
            
        $remisiones = remision::select(
            DB::raw('IFNULL(centrooperativo.nombre,"Sin Centro de Operación") as centrodeoperacion'),
            DB::raw('sum(round(totaldocumento,0)) as totalventas'),
            DB::raw("DATE_FORMAT(fechadocumento,'%M %Y') as months"),
            DB::raw("DATE_FORMAT(fechadocumento,'%m') as mes"),
            DB::raw("DATE_FORMAT(fechadocumento,'%d') as day"),
            DB::raw("fechadocumento as fecha"),
            DB::raw("'REM' as prefijo"))
            ->leftjoin('centrooperativo', 'remision.centrooper', '=', 'centrooperativo.codigo')
            ->where('remision.estado','=',1)
            ->whereBetween('fechadocumento',[$fechad,$fechah])
            ->whereBetween('horadocumento',[$horad,$horah])
            ->groupBy('fecha','centrodeoperacion','prefijo');
           // ->get();
         
        $ventas = factura::select(
            DB::raw('IFNULL(centrooperativo.nombre,"Sin Centro de Operación") as centrodeoperacion'),
            DB::raw('sum(round(totalfactura,0)) as totalventas'),
            DB::raw("DATE_FORMAT(fechafactura,'%M %Y') as months"),
            DB::raw("DATE_FORMAT(fechafactura,'%m') as mes"),
            DB::raw("DATE_FORMAT(fechafactura,'%d') as day"),
            DB::raw("fechafactura as fecha"),
            DB::raw("prefijo as prefijo"))
            ->leftjoin('centrooperativo', 'facturas.centrooper', '=', 'centrooperativo.codigo')
            ->unionAll($remisiones)
            ->where('facturas.estado','=',1)
            ->whereBetween('fechafactura',[$fechad,$fechah])
            ->whereBetween('horadefactura',[$horad,$horah])
            ->groupBy('fecha','centrodeoperacion','prefijo')
            ->get();            

        $consolidado = collect($ventas);

        $ventasConsolidadas = $consolidado->groupBy(function ($item) {
            return $item['fecha'] . '|' . $item['centrodeoperacion'] . '|' . $item['prefijo'];
                })->map(function ($grupo) {
                    $totalVentas = $grupo->sum(function ($item) {
                        return (int) $item['totalventas'];
                    });

                    $item = $grupo->first();
                    $item['totalventas'] = (int) $totalVentas;

                    return $item;
                })->values();

        $ventasjs =$ventas;
        $tot = 0;
        foreach($ventas as $dato)
          {
            $tot = $tot + $dato->totalventas;
          }

        return response()->json(
            [
             'status'   => '200',
             'msg'      => 'Ventas Diarias Consolidadas por Centros de operaciones (' . $fechad .'='.$fechah.')',
             'fechadesde' => $fechad ." ". $horad,
             'fechahasta' => $fechah ." ". $horah,
             'grantotal' => (int) $tot,
             'ventas'   => $ventasConsolidadas
            ],Response::HTTP_ACCEPTED);
    }

    public function DailyDetailedSales(Request $request):JsonResponse
    {
        DB::statement("SET lc_time_names = 'es_Es';");
        $fechad  = $request->fechadesde;
        $fechah  = $request->fechahasta;
        $horad   = $request->horadesde;
        $horah   = $request->horahasta;
        $anop  = $request->año;

        $remisiones = remision::select(
            DB::raw("fechadocumento as fechafactura"),
            DB::raw("fechadocumento as vencimiento"),
            DB::raw('consecutivo as numerodefactura'),
            DB::raw('tipodedocumento as tipodedocumento'),
            DB::raw('"REM" as prefijo'),
            DB::raw("horadocumento as horadefactura"),
            DB::raw('nit as nit'),
            DB::raw('remision.sucursal as sucursal'),
            DB::raw('nombreventa as nombreventa'),
            DB::raw(' "" as habitacion'),
            DB::raw('centrooperativo.nombre as centrodeoperacion'),
            DB::raw('vendedor.nombre as nombrevendedor'),
            DB::raw('remision.vendedor as vendedor'),
            DB::raw('round(valor,0) as valorfactura'),
            DB::raw('round(dsctosproductos+dsctosadicionales,0) as descuentos'),
            DB::raw('round(valoriva,0) as valoriva'),
            DB::raw('round(valoradicional,0) as valoradicional'),
            DB::raw('round(0,0) as retefuente'),
            DB::raw('round(0,0) as reteiva'),
            DB::raw('round(0,0) as reteica'),
            DB::raw('round(totaldocumento,0) as totaldocumento'),
            DB::raw('"" as cufe'),
            DB::raw('remision.estado as estado'),
            DB::raw('remision.estado01 as estado01'),
            DB::raw('remision.estado02 as estado02'),
            DB::raw('remision.estado03 as estado03'),
            DB::raw('remisionID as id'),
            DB::raw("DATE_FORMAT(fechadocumento,'%M %Y') as months"),
            DB::raw("DATE_FORMAT(fechadocumento,'%m') as mes"),
            DB::raw("DATE_FORMAT(fechadocumento,'%d') as day"))
            ->leftjoin('centrooperativo', 'remision.centrooper', '=', 'centrooperativo.codigo')
            ->leftjoin('vendedor', 'remision.vendedor', '=', 'vendedor.codigo')
            ->where('remision.estado','=',1)
            ->whereBetween('fechadocumento',[$fechad,$fechah])
            ->whereBetween('horadocumento',[$horad,$horah]);

         $ventas = factura::select(
            DB::raw("facturas.fechafactura"),
            DB::raw("facturas.fechavencimiento as vencimiento"),
            DB::raw('facturas.numerodefactura as numerodefactura'),
            DB::raw('facturas.tipodedocumento as tipodedocumento'),
            DB::raw("facturas.prefijo"),
            DB::raw("facturas.horadefactura as horadefactura"),
            DB::raw('facturas.nit as nit'),
            DB::raw('facturas.sucursal as sucursal'),
            DB::raw('nombreventa as nombreventa'),
            DB::raw('habitacion as habitacion'),
            DB::raw('centrooperativo.nombre as centrodeoperacion'),
            DB::raw('vendedor.nombre as nombrevendedor'),
            DB::raw('facturas.vendedor as vendedor'),
            DB::raw('round(valorfactura,0) as valorfactura'),
            DB::raw('round(descuentosproductos+descuentosadicionales,0) as descuentos'),
            DB::raw('round(valoriva,0) as valoriva'),
            DB::raw('round(valoradicional,0) as valoradicional'),
            DB::raw('round(retefuente,0) as retefuente'),
            DB::raw('round(reteiva,0) as reteiva'),
            DB::raw('round(reteica,0) as reteica'),
            DB::raw('round(totalfactura,0) as totalfactura'),
            DB::raw('cufe as cufe'),
            DB::raw('facturas.estado as estado'),
            DB::raw('facturas.estado01 as estado01'),
            DB::raw('facturas.estado02 as estado02'),
            DB::raw('facturas.estado03 as estado03'),
            DB::raw('facturasID as id'),
            DB::raw("DATE_FORMAT(fechafactura,'%M %Y') as months"),
            DB::raw("DATE_FORMAT(fechafactura,'%m') as mes"),
            DB::raw("DATE_FORMAT(fechafactura,'%d') as day"))
            ->leftjoin('centrooperativo', 'facturas.centrooper', '=', 'centrooperativo.codigo')
            ->leftjoin('vendedor', 'facturas.vendedor', '=', 'vendedor.codigo')
            ->unionAll($remisiones)
            ->where('facturas.estado','=',1)
            ->whereBetween('facturas.fechafactura',[$fechad,$fechah])
            ->whereBetween('facturas.horadefactura',[$horad,$horah])
            ->orderBy('fechafactura')
            ->orderBy('prefijo')
            // ->Orderby('facturas.numerodefactura')
            ->get();

        //$ventas->union($remisiones)->get();

        //$ventas = $remisiones;

        $ventasjs =$ventas;
        $tot = 0;
        foreach($ventas as $dato)
          {
            $tot = $tot + $dato->totalfactura;
          }

        return response()->json(
            [
             'status'   => '200',
             'msg'      => 'Ventas Detalladas Diarias (' . $fechad .'='.$fechah.')',
             'fechadesde' => $fechad ." ". $horad,
             'fechahasta' => $fechah ." ". $horah,
             'grantotal' =>  (int) $tot,
             'ventas'   => $ventas
            ],Response::HTTP_ACCEPTED);
    }

    public function DailyConsolidatedSales(Request $request):JsonResponse
    {

        $meses = array("Enero","Febrero","Marzo","Abríl","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        DB::statement("SET lc_time_names = 'es_Es';");
        $mes  = $request->mes;
        $anop  = $request->año;

        $remisiones = remision::select(
            DB::raw('IFNULL(centrooperativo.nombre,"Sin Centro de Operación") as centrodeoperacion'),
            DB::raw("sum(round(totaldocumento,0)) as totalventas"),
            DB::raw("DATE_FORMAT(fechadocumento,'%M %Y') as months"),
            DB::raw("DATE_FORMAT(fechadocumento,'%m') as mes"),
            //DB::raw("dias[ intval(DATE_FORMAT(fechafactura,'%w'))] as diadelasemana"),
            DB::raw("DATE_FORMAT(fechadocumento,'%w') as Iddia"),
            DB::raw("CASE DATE_FORMAT(fechadocumento,'%w') WHEN '0' THEN 'Domingo' WHEN '1' THEN 'Lunes'  WHEN '2' THEN 'Martes'  WHEN '3' THEN 'Miércoles'
                WHEN '4' THEN 'Jueves'  WHEN '5' THEN 'Viernes' ELSE 'Sábado' END AS diadelasemana"),
            DB::raw("remision.fechadocumento  as fechadocumento"))
            ->leftjoin('centrooperativo', 'remision.centrooper', '=', 'centrooperativo.codigo')
            ->where('remision.estado','=',1)
            ->whereMonth('fechadocumento',$mes)
            ->whereYear('fechadocumento',$anop )
            ->groupBy('centrodeoperacion','months','fechadocumento');
            //->get();

        $ventas = factura::select(
            DB::raw('IFNULL(centrooperativo.nombre,"Sin Centro de Operación") as centrodeoperacion'),
            DB::raw("sum(round(totalfactura,0)) as totalventas"),
            DB::raw("DATE_FORMAT(fechafactura,'%M %Y') as months"),
            DB::raw("DATE_FORMAT(fechafactura,'%m') as mes"),
            //DB::raw("dias[ intval(DATE_FORMAT(fechafactura,'%w'))] as diadelasemana"),
            DB::raw("DATE_FORMAT(facturas.fechafactura,'%w') as Iddia"),
            DB::raw("CASE DATE_FORMAT(facturas.fechafactura,'%w') WHEN '0' THEN 'Domingo' WHEN '1' THEN 'Lunes'  WHEN '2' THEN 'Martes'  WHEN '3' THEN 'Miércoles'
                WHEN '4' THEN 'Jueves'  WHEN '5' THEN 'Viernes' ELSE 'Sábado' END AS diadelasemana"),
            DB::raw("facturas.fechafactura  as fechafactura"))
            ->leftjoin('centrooperativo', 'facturas.centrooper', '=', 'centrooperativo.codigo')
            ->where('facturas.estado','=',1)
            ->whereMonth('fechafactura',$mes)
            ->whereYear('fechafactura',$anop )
            ->unionAll($remisiones)
            //->groupBy('centrodeoperacion','months','fechafactura')
            ->groupBy('months','fechafactura')
            ->get();


        //$consolidado = $ventas->collect('centrodeoperacion','fechafactura')->sum('totalventas')->groupBy(['centrodeoperacion','fechafactura']);
        $consolidado = collect($ventas);

        $ventasConsolidadas = $consolidado->groupBy('fechafactura')->map(function ($grupo) {
            $totalVentas = $grupo->sum(function ($item) {
                return (int) $item['totalventas'];
            });

            $diaDeLaSemana = $grupo->first()['diadelasemana'];
            $months        = $grupo->first()['months'];
            $mes           = $grupo->first()['mes'];
            $iddia         = $grupo->first()['iddia'];

            return [
                'centrodeoperacion'     => "",
                'totalventas'           => (int) $totalVentas,
                'months'                => $months,
                'mes'                   => $mes,
                'iddia'                 => $iddia,
                'diadelasemana'         => $diaDeLaSemana,
                'fechafactura'          => $grupo->first()['fechafactura'],
            ];
        })->values();


        $ventasjs =$ventas;
        $tot = 0.00;
        foreach($ventas as $dato)
        {
           $tot = $tot + $dato->totalventas;
        }

        $mesproceso = $meses[intval($mes) -1] . "-" . $anop;
        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Ventas Diarias Consolidadas Año ('. $anop .')',
             'grantotal'        => $tot,
             'mesproceso'       => $mesproceso,
             'ventas'           => $ventasConsolidadas,
            ],Response::HTTP_ACCEPTED);

    }

    public function ConsultInventories(Request $request):JsonResponse
    {
        $ctrl   = enlacevisual_nv::findOrFail(1);
        $anop   = $ctrl->anofacturacion;
        $lista  = $ctrl->listaxdefecto;

        $ctrl = enlacevisual_nv::findOrFail(1);
        $anop = $ctrl->anofacturacion;

        $anop         = $request->anoproceso;
        $producto     = $request->producto;

        $saldos = saldosdeinventario::select(
            DB::raw("saldosdeinventarios.producto as producto"),
            DB::raw("saldosdeinventarios.bodega as bodega"),
            DB::raw("saldosdeinventarios.lote as lote"),
            DB::raw("producto.descripcion as descripciondelproducto"),
            DB::raw("saldosdeinventarios.cantidad as cantidad"),
            DB::raw("saldosdeinventarios.cantidad1 as cantidad1"),
            DB::raw("saldosdeinventarios.costopromedio as costopromedio"),
            DB::raw("detalledelistas.valor as valordeventa"))
            ->join('producto', 'saldosdeinventarios.producto', '=', 'producto.codigo')
            ->join('detalledelistas', 'saldosdeinventarios.producto', '=', 'detalledelistas.producto')
            ->where('producto.descripcion', 'like', '%' . $producto . '%')
            ->where('saldosdeinventarios.anodeproceso',$anop )
            ->where('detalledelistas.codigo',$lista)
            ->having('saldosdeinventarios.cantidad',">",0)
            ->orderBy('producto.descripcion')
            ->orderBy('saldosdeinventarios.bodega')
            ->get();

        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Información de Saldos de Inventarios Año  ('. $anop .')',
             'saldos'             =>  $saldos,
            ],Response::HTTP_ACCEPTED);

    }
}
