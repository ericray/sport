<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificacioes';
    public $timestamps = false;

    public function empresas()
    {
        return $this->belongsToMany('App\Empresa');
    }

    public function usuarios()
    {
        return $this->belongsToMany('App\Usuario');
    }
}
