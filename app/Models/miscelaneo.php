<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class miscelaneo extends Model
{
    use HasFactory;
    protected $table = "miscelaneos";

    protected $fillable = [
        'codigoid','descripcion','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "miscelaneosid";
    public $timestamps = false;

    public function getKeyName(){

        return "miscelaneosID";
    }
}
