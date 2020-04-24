<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    //
    protected $table = 'medicamentos';
    protected $fillable = [
        'codigo_medicamento',
        'nombre_generico',
        'nombre_comercial',
        'id_formaf',
        'concentracion',
        'id_formap',
        'cantidad',
        'presentacion_comercial',
        'forma_farmaceutica',
        'alto_costo',
        'regulado',
        'user_id',
        'estado',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function formafarmaceutica()
    {
        return $this->hasOne(FormaFarmaceutica::class);
    }

    public function negociacion()
    {
        return $this->belongsTo(Negociacion::class);
    }

    public function linkedmed()
    {
        return $this->belongsTo(LinkedMedicamentos::class);
    }

}
