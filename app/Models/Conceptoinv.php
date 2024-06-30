<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conceptoinv extends Model
{
    use HasFactory;
    protected $table = "conceptoinv";
    protected $fillable = [
        'codigo','descripcion','tipo','tipodevalorizacion','porcentajeretefuente','montominimo','cptoclase','enlacectb','tipoconcepto','formatodeimpresion',
        'usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "conceptoinvid";
    public $timestamps = false;

    public function getKeyName()
    {
        return "conceptoinvID";
    }
}
