<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contenido extends Model
{
    use HasFactory;
    protected $table = "contenidos";
    public $timestamps = false;
    protected $fillable = ['ubicacion','titulo','imagen','idcontenido','pagina','usuario_created','usuario_updated','fecha_created','fecha_updated'];
}
