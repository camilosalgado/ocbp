<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    //
    protected $table = 'grupos';

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }

    public function subgrupo()
    {
        return $this->belongsTo(Subgrupo::class);
    }
}
