<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;
    protected $table = "listas";

    protected $fillable = [
        'codigo','descripcion','tipomoneda','factor','proyecto','sproyecto','centrooper','estado','usuario_created','usuario_updated',
        'fecha_created','fecha_updated'];

    protected $primaryKey = "listasid";
    public $timestamps = false;

    public function getKeyName()
    {
        return "ListasID";
    }
}
