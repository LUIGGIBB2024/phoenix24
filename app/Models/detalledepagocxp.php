<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalledepagocxp extends Model
{
    use HasFactory;
    protected $table = "detalledepagoscxp";

    protected $fillable = [
      'consecutivo','fechadocumento','documentopago','nit','sucursal','proyecto','sproyecto','centrooper','	actividad','lapso','cuenta','centro','scentro',
      'tipodemovimiento','numerodefactura','prefijo','documentofactura','conceptodepago','valordelpago','cuota','estado','estado01','estado02','EgresosID',
      'facturacxpID','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "detalledepagoscxpid";
    public $timestamps = false;

    public function getKeyName()
    {
        return "detalledepagoscxpID";
    }

}
