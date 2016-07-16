<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';
    public $timestamps = false;

    public function coordenada()
    {
        return $this->belongsTo('App\Coordenada');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
}
