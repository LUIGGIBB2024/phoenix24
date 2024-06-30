<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;
    protected $table = "producto";

    protected $fillable = [
        'codigo','descripcion','codigobarra','presentacion','porcentajeiva','factordeconversion','factorderentabilidad', 'factorlimitededescuentos',
        'valorultimacompra','fechaultimacompra','valorventa','costopromedio','unidadesxempaque','medida','grupo','subgrupo','division',
        'familia','referencia','categoria01','categoria02','categoria03','tipodeproducto','tipodecontrol','tipocalculo', 'ubicacion',
        'stockminimo','stockmaximo','facturable','requierebascula','pesodelproducto','codigocorto','impuestoalconsumo','codigoalterno','registroinvima',
        'codigocie10','codigocups','estado','estado01','rutafoto','foto','codigocum','agruparen','configcontableid','codigobarracaja','imagen',
        'usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "productoid";
    public $timestamps = false;

    public function getKeyName(){
        return "productoID";
    }

}
