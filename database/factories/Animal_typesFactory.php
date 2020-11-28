<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Animal_type;
use APP\Http\Animal;
use Faker\Generator as Faker;

$factory->define(Animal_type::class, function (Faker $faker) {
    return [
        // les colone de la table animal_type à remplire 
        'designation' => implode($faker->randomElements(['Cheval', 'chat'])),
        // 'animal_id' => 0,
        'user_id' => $faker->numberBetween(1, 3),
        'created_at' => now(),
        'updated_at' => now()
    ];
});