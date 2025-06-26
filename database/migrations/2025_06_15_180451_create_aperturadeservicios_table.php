<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAperturadeserviciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aperturadeservicios', function (Blueprint $table) 
        {
           $table->id();
           $table->datetime('fechareporte')->index()->index();
           $table->float('numerodeservicios',15,2);
           $table->float('totalservicios',15,2);
           $table->float('totalcomisiones',15,2);
           $table->float('porcentaje',6,2);
           $table->string('observaciones',250);
           $table->numeric('tipo',3);
           $table->string('estado',10);
           $table->string('estado2',10);
           $table->string('usuario_created',20);
           $table->string('usuario_updated',20);
           $table->timestamp('fecha_created');
           $table->timestamp('fecha_updated');  
           $table->index(['echareporte','tipo','idregistro'],'idx_idregistro_tipo');         
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aperturadeservicios');
    }
}
