<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalledepago extends Model
{
    use HasFactory;
    protected $table = "detalledepagoscxc";

    protected $fillable = [
      'consecutivo','fechadocumento','documentopago','nit','sucursal','proyecto','sproyecto','centrooper','actividad','lapso','cuenta','centro' ,'scentro','concepto',
      'valor','numerodefactura','tipodocumento','prefijo','cuota','saldofactura','fechapagodeservicios','facturacxcid','recibodecajaID','notacreditoID',
      'usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "detallereccajasid";
    public $timestamps = false;

    public function getKeyName(){
        return "detallereccajasID";
    }

}
