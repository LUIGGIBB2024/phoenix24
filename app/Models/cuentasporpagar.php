<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuentasporpagar extends Model
{
    use HasFactory;
    protected $table = "cuentasporpagar";

    protected $fillable = [
        'numerofactura','prefijo','tipodedocumento','fechafactura','nit','sucursal','fechadevencimiento','proyecto','sproyecto','centrooper','actividad','lapso','cuenta','centro','scentro',
        'tipomvto','placa','propiedad','nitarrendatario','sucursalarrendatario','fechadepago','numeroegreso','tipoderegistro','dsctopp1','dsctopp2','dsctopp3','dsctopp4','dsctopp5','dia1pp',
        'dia2pp','dia3pp','dia4pp','dia5pp','valordeterioro','estado','estado01','estado02','valorfactura',
        'usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "cuentasporpagarid";
    public $timestamps = false;

    public function getKeyName(){
        return "cuentasporpagarID";
    }
}
