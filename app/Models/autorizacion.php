<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class autorizacion extends Model
{
    use HasFactory;

    protected $table = "documentosautorizados";
    protected $fillable = [
        'id','numerodedocumento','tipodedocumento','prefijo','tipo','accion','fechadereporte',
        'fechadesde','fechahasta','estado01','estado02','estado03','nit','sucursal','nombredeltercero','valordelafactura',
        'pin','observaciones','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    //protected $primaryKey = "facturasid";
    public $timestamps = false;

    //public function getKeyName()
    //{
    //   return "FacturasID";
    //}
}
