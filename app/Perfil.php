<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //relacion inversa

    public function perfilUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
