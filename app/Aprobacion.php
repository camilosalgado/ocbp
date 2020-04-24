<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aprobacion extends Model
{
    //
    protected $table = 'aprobaciones';
    protected $fillable = [
        'nro_orden_hosvital',
        'estado',
        'user_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
