<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Proprietaire;
use Faker\Generator as Faker;

$factory->define(Proprietaire::class, function (Faker $faker) {
    return [
        'nom' => $faker->name,
        'prenom' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'adresse' => $faker->streetAddress,
        'code_postal' => $faker->postcode,
        'ville' => $faker->city,
        'telephone' => $faker->phoneNumber,
        'animal_id' => 0,
        'created_at' => now(),
        'updated_at' => now()
        //
    ];
});
