<?php

namespace App\Policies;

use App\User;
use App\Animal_types;
use Illuminate\Auth\Access\HandlesAuthorization;

class Animal_typesPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any animal_types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the animal_types.
     *
     * @param  \App\User  $user
     * @param  \App\Animal_types  $animalTypes
     * @return mixed
     */
    public function view(User $user, Animal_types $animalTypes)
    {
        //
    }

    /**
     * Determine whether the user can create animal_types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the animal_types.
     *
     * @param  \App\User  $user
     * @param  \App\Animal_types  $animalTypes
     * @return mixed
     */
    public function update(User $user, Animal_types $animalTypes)
    {
        //
    }

    /**
     * Determine whether the user can delete the animal_types.
     *
     * @param  \App\User  $user
     * @param  \App\Animal_types  $animalTypes
     * @return mixed
     */
    public function delete(User $user, Animal_types $animalTypes)
    {
        //
    }

    /**
     * Determine whether the user can restore the animal_types.
     *
     * @param  \App\User  $user
     * @param  \App\Animal_types  $animalTypes
     * @return mixed
     */
    public function restore(User $user, Animal_types $animalTypes)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the animal_types.
     *
     * @param  \App\User  $user
     * @param  \App\Animal_types  $animalTypes
     * @return mixed
     */
    public function forceDelete(User $user, Animal_types $animalTypes)
    {
        //
    }
}
