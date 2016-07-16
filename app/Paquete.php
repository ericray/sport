<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    protected $table = 'paquetes';
    public $timestamps = false;

    public function empresas()
    {
        return $this->belongsToMany('App\Empresa');
    }
}
