<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otrospagosventa extends Model
{
    protected $table = "otrospagosventas";
    protected $fillable = [
        'consecutivo','tipodocumento','fechadocumento','lapso','nrodocumento','concepto','banco','fechadecheque','plaza','valor','proyecto','sproyecto','actividad','centrooper',
        'idlocal','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "otrospagosventasid";
    public $timestamps = false;

    public function getKeyName()
    {
        return "OtrosPagosVentasID";
    }
}

