<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudades';

    public function empresas()
    {
        return $this->hasMany('App\Empresa');
    }

    public function usuarios()
    {
        return $this->hasMany('App\Usuario');
    }
}
