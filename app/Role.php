<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'roles';
    protected $fillable = ['descripcion', 'user_id', 'estado'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
