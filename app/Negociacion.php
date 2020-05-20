<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negociacion extends Model
{
    //
    protected $table = 'negociaciones';

    public $timestamps = false;

    protected $fillable = [
        "med_id",
        "lab_id",
        "vpropuesta",
        "obs_descuento",
        "vnegociacion",
        "utilidad",
        "cantidad",
        "aprob_farmacia",
        "user_id",
        "estado",
        'created_at',
        'updated_at'
    ];

    public function medicamento()
    {
        return $this->hasOne(Laboratorio::class);
    }

    public function laboratorio()
    {
        return $this->hasOne(Laboratorio::class);
    }

}
