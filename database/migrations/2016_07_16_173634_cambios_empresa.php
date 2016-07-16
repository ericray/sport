<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambiosEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table){
            $table->unsignedInteger('coordenada_id');
            $table->integer('tipo'); //ej. empresa o couch

            $table->foreign('coordenada_id')->references('id')->on('coordenadas');
        });

        Schema::create('deportes', function (Blueprint $table){
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
        });

        Schema::create('deporte_empresa', function (Blueprint $table){
            $table->unsignedInteger('deporte_id');
            $table->unsignedInteger('empresa_id');

            $table->foreign('deporte_id')->references('id')->on('deportes');

            $table->foreign('empresa_id')->references('id')->on('empresas');
        });

        Schema::table('partidos', function (Blueprint $table){
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamp('fecha_inicio');
            $table->timestamp('fecha_fin');
            $table->integer('cantidad');
            $table->unsignedInteger('deporte_id');

            $table->foreign('deporte_id')->references('id')->on('deportes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deporte_empresa');
        Schema::drop('deportes');

        Schema::table('empresas', function (Blueprint $table){
            $table->dropColumn('tipo');
            $table->dropForeign('empresas_coordenada_id_foreign'); //{nombre_tabla}_{nombre_foreign}_foreign11
            $table->dropColumn('coordenada_id');
        });
        Schema::table('partidos', function (Blueprint $table){
            $table->dropColumn('nombre');
            $table->dropColumn('descripcion');
            $table->dropColumn('fecha_inicio');
            $table->dropColumn('fecha_fin');
            $table->dropColumn('cantidad');
            $table->dropForeign('partidos_deporte_id_foreign'); //{nombre_tabla}_{nombre_foreign}_foreign11
            $table->dropColumn('deporte_id');
        });
    }
}
