<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaPresentacion extends Model
{
    //
    protected $table = 'forma_presentacion';
    protected $fillable = [
        'descripcion',
        'user_id',
        'estado'
    ];

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }
}
