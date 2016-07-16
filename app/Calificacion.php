<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = 'calificaciones';
    public $timestamps = false;

    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Usuario');
    }
}
