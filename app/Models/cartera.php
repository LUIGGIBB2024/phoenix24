<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cartera extends Model
{
    use HasFactory;
    protected $table = "cuentasporcobrar";

    protected $fillable = [
        'numerodefactura','tipodedocumento','prefijo','nit','sucursal','fechafactura','fechadevencimiento','lapso','valorfactura','valorcuota','valorintereses',
        'valorseguro','numerodecuota','proyecto','sproyecto','centrooper','actividad','cuenta','centro','scentro','tipodemovimiento','tipod','porcentaje','tipodeprestamo',
        'dia1','dia2','propiedad','rutadeventa','zonadeventa','vendedor','valordeterioro','estado','facturaid','clientesid',
        'usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "cuentasporcobrarid";
    public $timestamps = false;

    public function getKeyName(){
        return "cuentasporcobrarID";
    }

    public function detalledepagos()
    {
       return $this->hasMany(detalledepago::class,'facturacxcID','cuentasporcobrarID');
    }
}
