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
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
