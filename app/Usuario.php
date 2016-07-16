<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    public function calificaciones()
    {
        return $this->hasMany('App\Calificacion');
    }

    public function partido() //partido que crea el usuario
    {
        return $this->hasOne('App\Partido');
    }

    public function reservaciones()
    {
        return $this->hasMany('App\Reservacion');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }

    public function notificaciones()
    {
        return $this->belongsToMany('App\Notificacion');
    }

    public function partidos() //partidos por usuarios que participante en este
    {
        return $this->belongsToMany('App\Partido');
    }
}
