<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
        {
            Schema::create('clientes', function (Blueprint $table) {
                $table->bigIncrements('clientesID',22)->primary();
                $table->string('nit',20);
                $table->string('sucursal',10);
                $table->string('codigo',10);
                $table->string('nombreprimero',50);
                $table->string('nombresegundo',50);
                $table->string('dv',1);
                $table->string('apellidoprimero',50);
                $table->string('apellidosegundo',50);
                $table->string('nombrecompleto',200);
                $table->string('direccion',254);
                $table->string('telefono',50);
                $table->string('email',150)->unique();
                $table->string('razonzocial',200);
                $table->string('contacto',200);
                $table->float('cupodecartera',22,2);
                $table->float('plazocartera',17,2);
                $table->float('diascontrol',17,2);
                $table->float('puntos',17,2);
                $table->float('puntosacumulados',17,2);
                $table->string('barrio',10);
                $table->string('segmento',10);
                $table->string('rutadeventa',10);
                $table->string('zonadeventa',10);
                $table->string('tipodecliente',10);
                $table->string('vendedor',10);
                $table->string('ciudad',10);
                $table->string('categoria01',10);
                $table->string('categoria02',10);
                $table->numeric('sexo',1);
                $table->numeric('declararentas',1);
                $table->numeric('manejapuntos',1);
                $table->numeric('retencionautomatica',1);
                $table->string('actividadautomatica',20);
                $table->numeric('tipoderegimen',1);
                $table->string('matriculamercantil',30);
                $table->string('zonapostal',30);
                $table->string('obligacionesfiscal',30);
                $table->date('fechadenacimiento');
                $table->string('codigoprestador',20);
                $table->date('fechadecreacion');
                $table->date('fechaultimacompra');
                $table->date('fechafinaldecontrato');
                $table->string('rutafoto',200);
                $table->date('fechaultimopago');
                $table->string('rutafirma',200);
                $table->string('numerodecontrato',20);
                $table->string('propiedad',20);
                $table->float('canon',17,2);
                $table->float('administracion',17,2);
                $table->float('porcentaje',26,6);
                $table->float('iva',8,2);
                $table->string('idlocal',20);
                $table->numeric('tipodedocumento',1);
                $table->string('ocupacion',60);
                $table->string('nacionalidad',60);
                $table->string('observaciones',254);
                $table->string('empresa',10);
                $table->numeric('tipodepropiedad',1);
                $table->numeric('tipodearrendatario',1);
                $table->float('ivapropietario',22,8);
                $table->float('porcentajedeincremento',22,8);
                $table->numeric('tipodeclienteinmobiliaria',1);
                $table->string('proyecto',10);
                $table->string('sproyecto',10);
                $table->string('centrooper',10);
                $table->numeric('estado',11);
                $table->numeric('estado01',1);
                $table->numeric('tipodeclarante',1);
                $table->string('direcciondeentrega',200);
                $table->string('telefonodeentrega',50);
                $table->string('ciudaddeentrega',50);
                $table->string('contactodeentrega',50);
                $table->float('factoractividadeconomica',22,8);
                $table->bigInteger('tercerosID',22)->index();
                $table->string('cuenta',20);
                $table->string('centro',10);
                $table->string('scentro',10);
                $table->double('altitud',22,8);
                $table->double('longitud',22,8);
                $table->string('usuario_created',20);
                $table->string('usuario_updated',20);
                $table->timestamp('fecha_created');
                $table->timestamp('fecha_updated');
            });
        }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
