<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reportedeservicio extends Model
{
    use HasFactory;
    protected $table = "reportedeservicios";
    protected $fillable = [
    'idregistro','producto','descripcion','vendedor','placa','echadereporte','cantidad','valor','comision','porcentaje','observaciones','tipo','estado','usuario_created','usuario_updated','fecha_created',
    'fecha_updated'];
  }