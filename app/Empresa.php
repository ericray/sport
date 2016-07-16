<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';
    public $timestamps = false;

    public function calificaciones()
    {
        return $this->hasMany('App\Calificacion');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }

    public function eventos()
    {
        return $this->hasMany('App\Evento');
    }

    public function reservaciones()
    {
        return $this->hasMany('App\Reservacion');
    }

    public function notificaciones()
    {
        return $this->belongsToMany('App\Notificacion');
    }

    public function paquetes()
    {
        return $this->belongsToMany('App\Paquete');
    }

    public function servicios()
    {
        return $this->belongsToMany('App\Servicio');
    }

    public function deportes()
    {
        return $this->belongsToMany('App\Deporte');
    }

    public function coordenada()
    {
        return $this->belongsTo('App\Coordenada');
    }
}
