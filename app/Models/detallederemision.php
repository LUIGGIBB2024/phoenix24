<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallederemision extends Model
{
    use HasFactory;
    protected $table = "detallederemision";
    protected $fillable = [
        'nit','sucursal','consecutivo','tipodedocumento','fechadocumento','fechadevencimiento','lapso','producto','descripcion','bodega','lote','codigobarra','cantidad','cantidad1','costopromedio','valor','descuento1','descuento2','descuento3',
        'valordescuento1','valordescuento2','valordescuento3','ivaproducto','impoconsumo','concepto','cptoclase','serial','garantia','placa','proyecto','sproyecto','centrooper','actividad','cuenta','centro','scentro','tipodemovimiento',
        'propiedad','rutadeventa','zonadeventa','vendedor','tecnico','producto2','tipodecliente','estado','estado01','estado02','estado03','idregistro','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "detallederemisionid";
    public $timestamps = false;

    public function getKeyName()
    {
       return "DetalleDeRemisionID";
    }
}
