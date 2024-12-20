<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalledeotrospago extends Model
{
    use HasFactory;
    protected $table = "detalledeotrospagos";

    protected $fillable = [
     'consecutivo','tipodocumento','fechadocumento','lapso','nit','conceptodepago','sucursal','cuenta','centro','scentro','tipodemovimiento',
     'placa','valordelpago','nittercero','sucursaltercero','observaciones','numerorecibodecaja','docrecibodecaja','nitarrendatario',
     'sucursalarrendatario','propiedad','estado','estado01','estado02','proyecto','sproyecto','centrooper','actividad','egresosid',
     'usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "detalledeotrospagosid";
    public $timestamps = false;

    public function getKeyName(){
        return "detalledeotrospagosID";
    }
}
