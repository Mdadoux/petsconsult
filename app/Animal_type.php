<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal_type extends Model
{
    //liaison avec la table animals

    public function animals()
    {

        return $this->hasMany('App\Animal');
    }
    public function user()
    {

        return $this->belongsTo(User::class);
    }
}