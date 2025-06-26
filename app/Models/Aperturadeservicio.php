<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aperturadeservicio extends Model
{
    use HasFactory;
    protected $table = "aperturadeservicios";
    protected $fillable = [
    'fechareporte','numerodeservicios','totalservicios','totalcomisiones','observaciones','tipo','vendedor','estado','estado2','usuario_created','usuario_updated','fecha_created',
    'fecha_updated'];

    public $timestamps = false;
}
