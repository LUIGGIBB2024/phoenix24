<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;
    protected $table = "clientes";
    protected $fillable = [
        'nit','sucursal','codigo','nombreprimero','nombresegundo','dv','apellidoprimero', 'apellidosegundo',
        'nombrecompleto','direccion','telefono','email','razonzocial','contacto','cupodecartera','plazocartera',
        'diascontrol','puntos','puntosacumulados','barrio','segmento','rutadeventa','zonadeventa','tipodecliente', 'vendedor','lista',
        'ciudad','categoria01','categoria02','sexo','declararentas','manejapuntos','retencionautomatica','actividadautomatica','tipoderegimen',
        'matriculamercantil','zonapostal','obligacionesfiscal','fechadenacimiento','codigoprestador','fechadecreacion','fechaultimacompra',
        'fechafinaldecontrato','rutafoto','fechaultimopago','rutafirma', 'numerodecontrato','propiedad','canon','administracion','porcentaje',
        'iva','idlocal','tipodedocumento','ocupacion','nacionalidad','observaciones','empresa','tipodepropiedad','tipodearrendatario','ivapropietario',
        'porcentajedeincremento','tipodeclienteinmobiliaria','proyecto','sproyecto','centrooper','estado','estado01','tipodeclarante','direcciondeentrega',
        'telefonodeentrega','ciudaddeentrega','contactodeentrega','factoractividadeconomica','tercerosID','cuenta','centro','scentro','altitud',
        'longitud','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "clientesid";
    public $timestamps = false;

    public function getKeyName(){
        return "clientesID";
    }

}

