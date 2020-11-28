<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    //mise en relation avec les consultations
    public function consultations()
    {

        return $this->hasMany(Consultation::class);
    }
    public function animal_types()
    {
        return $this->hasMany('App\Animal_type');
    }
    public function animals()
    {

        return $this->hasMany(Animal::class);
    }
    public function proprietaires()
    {

        return $this->hasMany('App\Proprietaire');
    }
}