<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciudades', function (Blueprint $table){
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('empresas', function (Blueprint $table){
            $table->increments('id');
            $table->string('nombre');
            $table->string('correo');
            $table->string('contrasenia');
            $table->timestamp('fecha_nacimiento');
            $table->unsignedInteger('ciudad_id');

            $table->foreign('ciudad_id')->references('id')->on('ciudades');
        });

        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('correo',200);
            $table->string('contrasenia');
            $table->timestamp('fecha_nacimiento');
            $table->unsignedInteger('ciudad_id');
            $table->timestamps();

            $table->foreign('ciudad_id')->references('id')->on('ciudades');
        });

        Schema::create('paquetes', function (Blueprint $table){
            $table->increments('id');
            $table->string('nombre');
            $table->integer('limite');
            $table->integer('limite_eventos');
            $table->integer('duracion');
        });

        Schema::create('coordenadas', function (Blueprint $table){
            $table->increments('id');
            $table->decimal('latitud');
            $table->decimal('longitud');
        });
        
        Schema::create('reservaciones', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('usuario_id');
            $table->unsignedInteger('empresa_id');
            $table->unsignedInteger('coordenada_id');
            $table->timestamp('fecha');
            $table->decimal('precio');


            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('coordenada_id')->references('id')->on('coordenadas');
        });

        Schema::create('notificaciones', function (Blueprint $table){
            $table->increments('id');
            $table->string('titulo');
            $table->string('mensaje');
            $table->timestamp('fecha');
            $table->integer('visto');
        });

        Schema::create('partidos', function (Blueprint $table){
            $table->increments('id');
            $table->integer('edad_maxima');
            $table->integer('edad_minima');
            $table->unsignedInteger('usuario_id');
            $table->unsignedInteger('coordenada_id');

            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('coordenada_id')->references('id')->on('coordenadas');
        });

        Schema::create('eventos', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('coordenada_id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamp('fecha');
            $table->decimal('precio');
            $table->unsignedInteger('empresa_id');

            $table->foreign('coordenada_id')->references('id')->on('coordenadas');
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });

        Schema::create('servicios', function (Blueprint $table){
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->decimal('precio');
        });

        Schema::create('empresa_servicio', function (Blueprint $table){
            $table->unsignedInteger('empresa_id');
            $table->unsignedInteger('servicio_id');

            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('servicio_id')->references('id')->on('servicios');

            $table->primary(['empresa_id', 'servicio_id']);
        });

        Schema::create('pagos', function (Blueprint $table){
            $table->increments('id');
            $table->integer('estatus');
            $table->unsignedInteger('reservacion_id');

            $table->foreign('reservacion_id')->references('id')->on('reservaciones');
        });

        Schema::create('calificaciones', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('empresa_id');
            $table->unsignedInteger('usuario_id');
            $table->string('comentario');
            $table->integer('raiting');
        });

        Schema::create('partido_usuario', function (Blueprint $table){
            $table->unsignedInteger('partido_id');
            $table->unsignedInteger('usuario_id');

            $table->foreign('partido_id')->references('id')->on('partidos');
            $table->foreign('usuario_id')->references('id')->on('usuarios');

            $table->primary(['partido_id', 'usuario_id']);
        });

        Schema::create('notificacion_usuario', function (Blueprint $table){
            $table->unsignedInteger('notificacion_id');
            $table->unsignedInteger('usuario_id');

            $table->foreign('notificacion_id')->references('id')->on('notificaciones');
            $table->foreign('usuario_id')->references('id')->on('usuarios');

            $table->primary(['notificacion_id', 'usuario_id']);
        });

        Schema::create('empresa_notificacion', function (Blueprint $table){
            $table->unsignedInteger('empresa_id');
            $table->unsignedInteger('notificacion_id');

            $table->foreign('notificacion_id')->references('id')->on('notificaciones');
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->primary(['notificacion_id', 'empresa_id']);
        });

        Schema::create('empresa_paquete',function (Blueprint $table){
            $table->unsignedInteger('empresa_id');
            $table->unsignedInteger('paquete_id');

            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('paquete_id')->references('id')->on('paquetes');

            $table->primary(['empresa_id','paquete_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('empresa_paquete');
        Schema::drop('empresa_notificacion');
        Schema::drop('notificacion_usuario');
        Schema::drop('partido_usuario');
        Schema::drop('calificaciones');
        Schema::drop('pagos');
        Schema::drop('empresa_servicio');
        Schema::drop('servicios');
        Schema::drop('eventos');
        Schema::drop('partidos');
        Schema::drop('notificaciones');
        Schema::drop('reservaciones');
        Schema::drop('coordenadas');
        Schema::drop('paquetes');
        Schema::drop('usuarios');
        Schema::drop('empresas');
        Schema::drop('ciudades');

    }
}
