<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    protected $table = 'reservaciones';
    public $timestamps = false;

    public function pagos()
    {
        return $this->hasMany('App\Pago');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Usuario');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }

    public function coordenada()
    {
        return $this->belongsTo('App\Coordenada');
    }
}
