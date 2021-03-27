<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'url',
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

    /* Relacion: uno a muchos - 1:n usuario->recetas*/
    public function userRecetas(){
        return $this->hasMany(Receta::class);
    }

    //evento cuando se cree un usuario->perfil

    protected static function booted(){
        parent::booted();

        static::created(function($user){
            $user->userPerfil()->create();

        });

    }

    //relacion 1:1
    public function userPerfil(){
        return $this->hasOne(Perfil::class);
    }

}
