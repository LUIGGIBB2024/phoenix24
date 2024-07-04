<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalledeautorizacion extends Model
{
    use HasFactory;

    protected $table = "detalledocumentosautorizados";
    protected $fillable = [
        'idregistro','idautorizacion','nit','sucursal','fechadereporte','numerodefactura','producto','descripcion','cantidad',
        'descuento1','descuento2','iva','valor','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "idregistro";
    public $timestamps = false;

    public function getKeyName()
    {
       return "idregistro";
    }
}
