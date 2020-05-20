<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    //
    protected $table = 'laboratorios';
    public $timestamps = false;

    protected $fillable = [
        'razon_social',
        'nit',
        'farmacia',
        'direccion',
        'telefono',
        'user_id',
        'estado',
        'created_at',
        'updated_at'
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
