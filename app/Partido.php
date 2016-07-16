<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $table = 'partidos';
    public $timestamps = false;

    public function usuario() //el administrador que crea el partido
    {
        return $this->belongsTo('App\Usuario');
    }

    public function coordenada()
    {
        return $this->belongsTo('App\Coordenada');
    }

    public function usuarios() //usuarios que participan en el partido
    {
        return $this->belongsToMany('App\Usuario');
    }
}
