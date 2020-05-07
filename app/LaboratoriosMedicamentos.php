<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratoriosMedicamentos extends Model
{
    //
    protected $table = 'laboratorios_medicamentos';

    protected $fillable =[
        'med_id',
        'lab_id',
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
