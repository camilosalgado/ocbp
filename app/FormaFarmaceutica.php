<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaFarmaceutica extends Model
{
    //
    protected $table = 'forma_farmaceuticas';

    protected $fillable = [
        'descripcion',
        'user_id',
        'estado'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }
}
