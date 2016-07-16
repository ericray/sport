<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';
    public $timestamps = false;

    public function empresas()
    {
        return $this->belongsToMany('App\Empresa');
    }
}
