<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observaciones extends Model
{
    //
    protected $table = 'observaciones';

    protected $fillable = [
        'descripcion', 'estado', 'user_id'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function medobs()
    {
        return $this->belongsTo(MedicamentoObservaciones::class);
    }

}
