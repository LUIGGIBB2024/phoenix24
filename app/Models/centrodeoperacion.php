<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class centrodeoperacion extends Model
{
    use HasFactory;
    protected $table = "centrooperativo";

    protected $fillable = [
        'codigo','descripcion','direccion','telefono','estado','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "centrooperativoid";
    public $timestamps = false;

    public function getKeyName(){

        return "centrooperativoID";
    }

}
