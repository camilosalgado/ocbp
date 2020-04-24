<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkedMedicamentos extends Model
{
    //
    protected $table = 'linked_medicamentos';
    protected $fillable = [
        'id_medicamento',
        'h_MSRESO',
        'h_DESCRIPCION',
        'h_MSNomG',
        'h_MSReg',
        'user_id'
    ];

    public function medicamento()
    {
        return $this->hasOne(Medicamento::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
