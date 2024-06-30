<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saldosdeinventario extends Model
{
    use HasFactory;
    protected $table = "saldosdeinventarios";

    protected $fillable = [
        'ProductoID','anodeproceso','producto','bodega','lote','saldoanterior','saldoanterior1','cantidad','cantidad1','ultimocosto','costopromedio','costop00','costop01','costop02','costop03','costop04','costop05',
        'costop06','costop07','costop08','costop09','costop10','costop11','costop12','entrada01','entrada02','entrada02','entrada03','entrada04','entrada05','entrada06','entrada07','entrada08','entrada09','entrada10',
        'entrada11','entrada12','salida01','salida02','salida03','salida04','salida05','salida06','salida07','salida08','salida09','salida10','salida11','salida12','valornetorealizable','valornr00','	valornr01','valornr02',
        'valornr03','valornr04','valornr05','valornr06','valornr07','valornr08','valornr09','valornr10','valornr11','valornr12','pesoent01','pesoent02','pesoent03','pesoent04','pesoent05','pesoent06','pesoent07','pesoent08',
        'pesoent09','pesoent10','pesoent11','pesoent12','pesosal01','pesosal02','pesosal03','pesosal04','pesosal05','pesosal06','pesosal07','pesosal08','pesosal09','pesosal10','pesosal11','pesosal12','fisicocantidad1',
        'fisicocantidad1','fisicocantidad2','fisicocantidad3','fisicopeso1','fisicopeso2','fisicopeso2','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "saldosdeinventariosID";
    public $timestamps = false;

    public function getKeyName(){
        return "saldosdeinventariosID";
    }
}
