<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateContenidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenidos', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('idcontenido')->index();
            $table->string('ubicacion',250);
            $table->string('titulo',250);
            $table->string('imagen',250);
            $table->integer('pagina')->index();;
            $table->string('usuario_created',20);
            $table->string('usuario_updated',20);
            $table->timestamp('fecha_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('fecha_updated')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contenidos');
    }
}
