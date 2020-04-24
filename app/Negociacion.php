<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negociacion extends Model
{
    //
    protected $table = 'negociaciones';
    protected $fillable = [
        "id_medicamento",
        "id_laboratorio",
        "valor_propuesta",
        "obs_descuento",
        "valor_negociacion",
        "precio_regulado",
        "utilidad",
        "aprobacion_farmacia",
        "id_user",
        "estado"
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
