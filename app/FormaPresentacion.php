<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaPresentacion extends Model
{
    //
    protected $table = 'forma_presentaciones';
    protected $fillable = [
        'descripcion',
        'user_id',
        'estado'
    ];

    public $timestamps = false;

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }
}
