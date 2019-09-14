<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proprietaire extends Model
{
    //

    public function animals()
    {

        return $this->hasMany('App\Animal');
    }
}
