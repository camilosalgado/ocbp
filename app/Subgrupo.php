<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subgrupo extends Model
{
    //
    protected $table = 'subgrupos';

    public function grupo()
    {
        return $this->hasOne(Grupo::class);
    }

}
