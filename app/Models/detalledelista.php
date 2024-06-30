<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalledelista extends Model
{
    use HasFactory;
    protected $table = "detalledelistas";

    protected $fillable = [
         'codigo','producto','valorantesdeiva','valor','valorunidad','valorunifinal','iva','descuento','proyecto','	sproyecto','centrooper',
         'usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "detalleDeListasid";
    public $timestamps = false;

    public function getKeyName()
    {

        return "DetalleDeListasID";
    }
}
