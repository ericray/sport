<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
    protected $table = 'deportes';
    public $timestamps = false;

    public function empresas()
    {
        return $this->belongsToMany('App\Empresa');
    }
}
