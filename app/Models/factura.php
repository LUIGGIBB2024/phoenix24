<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    use HasFactory;

    protected $table = "facturas";
    protected $fillable = [
        'numerodefactura','tipodedocumento','prefijo','cuenta','centrooper','proyecto','sproyecto','actividad','centro','scentro','lapso','paciente','nit','sucursal','nombreventa','fechafactura','fechadeentrada','fechadesalida','fechavencimiento',
        'horadefactura','habitacion','horashabitacion','minutoshabitacion','diashabitacion','cufe','observaciones','nitarrendatario','sucursalarrendatario','conceptodeinterface','propiedad','contrato','valorfactura','descuentosproductos',
        'descuentosadicionales','valoradicional','	flete','retefuente','reteiva','reteica','valoriva','otrasret1','otrasret2','otrasret3','otrasret4','otrasret5','ventasexentas','ventasgravadas','dsctoventasexentas','dsctoventasgravadas',
        'valordelpago','valorotrodocumento','valordescuento1','valordescuento2','valordescuento3','numerodepedido','numerodecompra','costodeventa','totalfactura','propina','saldoencartera','creeanterior','estado','estado01','estado02',
        'estado03','kilometraje','tipodefactura','vendedorid','clientesid','numeroderegistros','lista','plan','caja','cajero','mesa','mesero','transportador','placa','tipodepago','numerodedocumento','documentodian','tecnico','profesional',
        'codigodedescuento','tipodecliente','rutadeventa','zonadeventa','vendedor','numerodelreparto','montodelrecaudo','','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "facturasid";
    public $timestamps = false;

    public function getKeyName()
    {
       return "FacturasID";
    }
}
