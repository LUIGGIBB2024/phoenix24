<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalledemiscelaneo extends Model
{
    use HasFactory;
    protected $table = "detallemiscelaneos";
    protected $fillable = [
        'codigoid', 'codigo','descripcion','porcentaje1','porcentaje2','porcentaje3','porcentaje4','porcentaje5','valorfijo',
        'factor1','factor2','factor3','factor4','factor5','codigodepartamento','codigomunicipio','nit001','nit002','nit003',
        'nit004','nit005', 'campouti001','campouti002','campouti003','campouti004','campouti005','formtodeimpresion','tipodeformato',
        'cuenta','cuenta01','cuenta02','cuenta03','cuenta04','cuenta05','centro','scentro','tipodemovimiento','tipodeaplicacion',
        'tipomvto01','tipomvto02','tipomvto03','tipomvto04','tipomvto05','estado01','estado02','estado03','estado04','estado05',
        'identif01','identif02','identif03','identif04','identif05','documentoanexo','MiscelaneosID ','usuario_created','usuario_update',
        'fecha_created','fecha_updated'
    ];
    public $timestamps = false;
    protected $primaryKey = "DetalleMiscelaneosID";

     public function getKeyName(){

        return "detallemiscelaneosID";
    }
}
