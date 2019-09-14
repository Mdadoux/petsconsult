<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    /**
     * Get the animal related with the consultaion.
     */
    public function animal()
    {

        return $this->belongsTo('App\Animal');
    }
}
