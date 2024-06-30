<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class remision extends Model
{
    use HasFactory;
    protected $table = "remision";
    protected $fillable = [
    'consecutivo','tipodedocumento','fechadocumento','lapso','nit','sucursal','nombreventa','horadocumento','npedido','proyecto','sproyecto','centrooper','actividad','valor','valoriva','dsctosproductos',
    'dsctosadicionales','valoradicional','costodeventa','valorotrodocumento','impoconsumo','impuestoica','flete','totaldocumento','listadeprecio','rutadeventa','zonadeventa','vendedor','tipodecliente',
    'caja','cajero','mesa','mesero','observaciones','transportador','placa','kilometraje','	tipoderemision','estado','estado01','estado02','valordepago','usuario_created','usuario_updated',
    'fecha_created','fecha_updated'];

    protected $primaryKey = "remisionid";
    public $timestamps = false;

    public function getKeyName()
    {
       return "RemisionID";
    }
}
