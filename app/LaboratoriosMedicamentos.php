<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratoriosMedicamentos extends Model
{
    //
    protected $table = 'laboratorios_medicamentos';

    public $timestamps = false;

    protected $fillable =[
        'med_id',
        'lab_id',
        'user_id',
        'created_at',
        'updated_at',
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
