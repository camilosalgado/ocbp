<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    //
    protected $table = 'laboratorios';
    protected $fillable = [
        'razon_social',
        'nit',
        'direccion',
        'telefono',
        'user_id',
        'estado'
    ];

    public function laboratoriomedicamento()
    {
        return $this->belongsTo(LaboratoriosMedicamentos::class);
    }

    public function negociacion()
    {
        return $this->belongsTo(Negociacion::class);
    }

}
