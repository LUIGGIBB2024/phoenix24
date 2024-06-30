<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recibosdecaja extends Model
{
    use HasFactory;
    protected $table = "recibosdecaja";

    protected $fillable = [
      'consecutivo','tipodocumento','fechadocumento','lapso','nit','sucursal','valorefectivo','valorotro','observaciones','tipodepago','tipoderecibo','saldoactual','proyecto','sproyecto','centrooper',
      'actividad','cuenta','centro','scentro','tipodemovimiento','vendedor','estado','estado1','estado2','estado3','consecutivorcID',
      'usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "recibosdecajaid";
    public $timestamps = false;

    public function getKeyName()
    {
        return "recibosdecajaID";
    }

}
