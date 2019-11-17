<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{

    protected $fillable = ['nom', 'sexe', 'race', 'age', 'discipline', 'proprietaire_id', 'animal_types_id', 'updated_at'];
    /**
     * Get the consultaions for the animal.
     */

    public function consultations()
    {
        return $this->hasMany('App\Consultation');
    }

    // liaison avec un propietaire 
    public function proprietaire()
    {

        return $this->belongsTo('App\Proprietaire');
    }

    public function animal_type()
    {
        // renseigner de manière explicite la clès étrangère qui permet de lier la table animal à animal type
        return $this->belongsTo('App\Animal_type', 'animal_types_id');
    }
}
