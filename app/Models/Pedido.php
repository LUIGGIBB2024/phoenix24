<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = "pedidos";
    protected $fillable = [
        'consecutivo','tipodedocumento','fechadocumento','nit','sucursal','ncargue','horadepedido','nitaseguradora','sucursalaseg','nombreventa','nombres','apellidos','numerodepoliza','numerodesiniestro','fechadeentrega','horadeentrega','direcciondeentrega','telefonodeentrega',
        'reportedelcliente','observaciones','numerodeorden','vendedor','rutadeventa','zonadeventa','transportador','tipocliente','kilometraje','placa','numerodocumento','tipodepago','valorpedido','dsctosproductos','dsctosadicionales','lapso','valoriva',
        'retefuente','reteiva','reteica','valoradicional','totalpedido','costodeventa','valorotrodocumento','proyecto','sproyecto','centrooper','actividad','estado','estado01','estado02','reportedeltecnico','mesa','caja','cajero','tecnico','lista','latitud',
        'longitud','email','ciudad','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "pedidosid";
    public $timestamps = false;

    public function getKeyName()
    {
        return "PedidosID";
    }
}
