<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movimientosdeinventario extends Model
{
    protected $table = "movimientosdeinventarios";
    use HasFactory;



    protected $fillable = [
        'fechamovimiento','consecutivo','tipodedocumento','nit','sucursal','nit2','sucursal2','concepto','cptoclase','lapso',
        'facturadecompra','iddocumento','prefijo','placa','producto','bodega','lote','descripcion','ordendecompra','cuenta',
        'centro','scentro','proyecto','sproyecto','centrooper','actividad','tipodemovimiento','serial','cantidad','cantidad1',
        'valor','valornetorealizable','valorventa','costoreal','descuento1','descuento2','descuento3','ivaproducto','lotemedicamento',
        'fechadevencimiento','impoconsumo','estado','estado01','estado02','estado03','idregistro','ClientesID','ProveedoresID',
        'DocumentosdeinventariosID','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "movimientosdeinventariosID";
    public $timestamps = false;

    public function getKeyName()
    {
       return "movimientosdeinventariosID";
    }

}
