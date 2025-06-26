<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conceptoscxcpago extends Model
{
    use HasFactory;
    protected $table = "conceptospagoscxc";

    protected $fillable = [
        'concepto','descripcion','tipodeconcepto','tipodecalculo','proyecto','sproyecto','actividad','centrooper','	cuenta','centro',
        'scentro','cuentanc','	tipodemovimiento','aplicaracartera','generarnotacredito','indicador',
        'usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "conceptospagoscxcid";
    public $timestamps = false;

    public function getKeyName(){

        return "conceptospagoscxcID";
    }
}
