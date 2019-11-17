<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proprietaire extends Model
{
    //
    protected $fillable = ['nom', 'prenom', 'adresse', 'code_postal', 'ville', 'telephone', 'email', 'updated_at'];

    public function animals()
    {

        return $this->hasMany(Animal::class);
    }
}
