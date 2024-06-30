<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class detalledefactura extends Model
{
    use HasFactory;
    protected $table = "detalledefacturas";

    protected $fillable = [
        'numerodefactura','tipodedocumento','prefijo','nit','sucursal','fechadefactura','fechadevencimiento','proyecto','sproyecto','centrooper','cuenta','centro','scentro','lapso','tipodemovimiento',
        'producto','producto2','descripcion','bodega','lote','cantidad','cantidad1','valorventa','costopromedio','porcentajeiva','descuento1','descuento2','descuento3','valordescuento1','valordescuento2','valordescuento3',
        'idregistro','impoconsumo','concepto','cptoclase','garantia','serial','propiedad','tipocliente','rutadeventa','zonadeventa','vendedor','tecnico','facturasid','clientesid','estado','estado01','estado02',
        'estado03','idlocal','vehiculo','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "detalledefacturasid";
    public $timestamps = false;

    public function getKeyName(){
    return "detalledefacturasID";
    }

    static function getIdFactura($nit, $sucursal){
        $facturas = factura::where('nit',$nit)->where('sucursal',$sucursal) ->first();
        return $facturas->FactuasID;
    }

}


