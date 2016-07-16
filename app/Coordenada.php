<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordenada extends Model
{
    protected $table = 'coordenadas';
    public $timestamps = false;

    public function evento()
    {
        return $this->hasOne('App\Evento');
    }

    public function partido()
    {
        return $this->hasOne('App\Partido');
    }

    public function reservacion()
    {
        return $this->hasOne('App\Reservacion');
    }

    public function empresa()
    {
        return $this->hasOne('App\Empresa');
    }
}
