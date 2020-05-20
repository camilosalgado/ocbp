<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellido', 'usuario', 'id_tipodoc',
        'documento', 'email', 'password', 'id_rol', 'estado',
        'created_at', 'updated_at',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function tipodocs()
    {
        return $this->belongsTo(TipoDoc::class);
    }

    public function aprobacion()
    {
        return $this->belongsTo(Aprobacion::class);
    }

    public function linkedmed()
    {
        return $this->belongsTo(LinkedMedicamentos::class);
    }

}
