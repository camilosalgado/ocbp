<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    //
    protected $table = 'medicamentos';

    protected $fillable = [
        'codigo_medicamento',
        'cod_insumo',
        'nombre_generico',
        'nombre_comercial',
        'id_formaf',
        'id_formap',
        'concentracion',
        'cantidad',
        'presentacion_comercial',
        'id_grupomed',
        'posnopos',
        'alto_costo',
        'super_acosto',
        'regulado',
        'precio_regulado',
        'user_id',
        'estado',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;

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
