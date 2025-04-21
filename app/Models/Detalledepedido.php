<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalledepedido extends Model
{
    use HasFactory;
    protected $table = "detalledelpedido";
    protected $fillable = [
    'consecutivo','pedidosid','tipodedocumento','fechadocumento','nit','sucursal','proyecto','sproyecto','centrooper','lapso','nittercero','rutadeventa','zonadeventa','tipocliente','vendedor','lista','tecnico',
    'serial','garantia','producto','bodega','lote','descripcion','concepto','cptoclase','ncargue','cantidad','cantidad2','valor','descuento1','descuento2','descuento3','iva','costopromedio','fechadevencimiento',
    'estado','estado01','estado02','valorreal','placa','actividad', 'PedidosID','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "detalledelpedidoid";
    public $timestamps = false;

    public function getKeyName()
    {
        return "DetalleDelPedidoID";
    }

}
