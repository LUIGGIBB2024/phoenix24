<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documentosdeinventario extends Model
{
    use HasFactory;
    protected $table = "documentosdeinventarios";
    protected $fillable = [
        'consecutivo','concepto','cptoclase','nit','sucursal','fechademovimiento','facturadecompra','documentodecompra','fechadefactura','fechadevencimiento',
        'valordocumento','descuentoproductos','descuentoadicional','retefuente','reteiva','reteica','otrasret1','otrasret2','otrasret3','otrasret4','otrasret5',
        'totaldocumento','valoradicional','valoriva','ordendecompra','placa','proyecto','sproyecto','centrooper','centro','scentro','actividad','lapso','tipodemovimiento',
        'tipodecompra','conceptotraslado','cptoclasetraslado','estado','estado01','estado02','estado03','bodegatraslado','lotetraslado','ivaasumido','observaciones',
        'documentosdeinventariosID','cufe','msgevento1','msgevento2','msgevento3','fechavento1','fechavento2','fechavento3','codstatus','copdestino','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "documentosdeinventariosID";
    public $timestamps = false;

    public function getKeyName()
    {
        return "documentosdeinventariosID";
    }
}
