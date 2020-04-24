<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratoriosMedicamentos extends Model
{
    //
    protected $table = 'laboratorios_medicamentos';

    protected $fillable =[
        'id_laboratorio',
        'id_medicamento',
        'user_id'
    ];

    public function medicamento()
    {
        return $this->hasOne(Medicamento::class);
    }

    public function laboratorio()
    {
        return $this->hasOne(Laboratorio::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
