<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    public $timestamps = false;

    public function reservacion()
    {
        return $this->belongsTo('App\Reservacion');
    }
}
