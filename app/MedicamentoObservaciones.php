<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicamentoObservaciones extends Model
{
    //
    protected $table = 'medicamento_observaciones';

    protected $fillable = [
        'id_medicamento',
        'id_observacion',
        'user_id'
    ];

    public function medicamentos()
    {
        return $this->hasMany(Medicamento::class);
    }

    public function observaciones()
    {
        return $this->hasMany(Observaciones::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
