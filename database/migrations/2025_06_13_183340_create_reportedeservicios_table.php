<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportedeserviciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportedeservicios', function (Blueprint $table) 
        {
            $table->id();
            $table->bigInteger('idregistro',22)->index();
            $table->string('producto',20);
            $table->string('descripcion',20);
            $table->string('vendedor',10);
            $table->string('placa',20);
            $table->date('fechadereporte')->index();
            $table->float('cantidad',15,2);
            $table->float('valor',15,2);
            $table->float('comision',15,2);
            $table->float('porcentaje',6,2);
            $table->string('observaciones',250);
            $table->numeric('tipo',3);
            $table->string('estado',10);
            $table->string('estado2',10);
            $table->string('usuario_created',20);
            $table->string('usuario_updated',20);
            $table->timestamp('fecha_created');
            $table->timestamp('fecha_updated');
            $table->index(['fechadereporte','tipo','idregistro','producto'],'idx_tipo_producto');
            $table->index(['fechadereporte'],'idx_fechadereporte');
            $table->index(['placa','fechadereporte'],'idx_placa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportedeservicios');
    }
}
