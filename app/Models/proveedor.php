<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{
    use HasFactory;
    protected $table = "proveedores";
    protected $fillable = [
        'nit','sucursal','dv','tipodedocumento','nombreprimero','nombresegundo','apellidoprimero','apellidosegundo','nombrecompleto','razonsocial','ciudad','direccion','telefono','email','contacto',
        'telefonocontacto','tipodecontribuyente','cargo','actividadeconomica','codigoprestador','banco1','banco2','tipodecuenta1','tipodecuenta2','numerodecuenta1','numerodecuenta2','observaciones',
        'retencionesautomaticas','tipodeproveedor','tipoestado','diasdeplazo','consecutivodeprogracion','cuenta','centro','scentro','estado','estado01','latitud','longitud','usuario_created',
        'usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "proveedoresid";
    public $timestamps = false;

    public function getKeyName()
    {
        return "proveedoresID";
    }
}
