<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class origenesdepago extends Model
{
    use HasFactory;
    protected $table = "origendepagos";
    protected $fillable = [
        'codigo','descripcion','formatodeimpresion','proyecto','sproyeto','centrooper','actividad','cuenta','centro','scentro','tipodemovimiento','saldoinicial','numerodecuenta','incrementacheques','consecutivodecheque','nit',
        'usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "origendepagosid";
    public $timestamps = false;

    public function getKeyName()
    {
        return "origendepagosID";
    }
}
