<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Animal;
use App\Animal_type;
use App\Proprietaire;
use Faker\Generator as Faker;

$factory->define(Animal::class, function (Faker $faker) {
    return [
        //
        'nom' => $faker->firstName('Bandi' | 'Wisky' | 'Boundty' | 'Happy'),
        'sexe' => 'Mâl',
        'race' => 'Non communiqué',
        'age' => 0,
        'discipline' => 'Non communiqué',
        'visuel' => '',
        'proprietaire_id' => $faker->numberBetween(1, 5),
        'animal_types_id' => $faker->numberBetween(1, 2),
        'user_id' => $faker->numberBetween(1, 3)
    ];
});