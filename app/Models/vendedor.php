<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendedor extends Model
{
    use HasFactory;
    protected $table = "vendedor";
    protected $fillable = [
        'codigo', 'cedula','sucursal','nombre','direccion','telfono','email','estado','tipodecomision',
        'turno','centrooper','centrooperativoID','usuario_created','usuario_update','fecha_created','fecha_updated'
    ];
    protected $primaryKey = "vendedorID";
}

