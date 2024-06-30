<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class egreso extends Model
{
    use HasFactory;
    protected $table = "egresos";

    protected $fillable = [
        'consecutivo','tipodedocumento','lapso','fechadocumento','nit','sucursal','nombredeltercero','tipodeegreso','tipodepago','valorcxp',
        'otrospagos','fechadelcheque','fechadeentrega','banco','numerodecheque','proyecto','sproyecto','centrooper','actividad','enlacectb',
        'observaciones','estado','estado01','estado02','estado03','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "egresosid";
    public $timestamps = false;

    public function getKeyName()
    {
        return "egresosID";
    }

}
