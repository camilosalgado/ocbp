<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDoc extends Model
{
    //
    protected $table = 'tipo_docs';
    protected $fillable = ['sigla', 'descripcion', 'user_id', 'estado'];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
