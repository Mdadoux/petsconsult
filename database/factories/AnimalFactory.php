<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Animal;
use Faker\Generator as Faker;

$factory->define(Animal::class, function (Faker $faker) {
    return [
        //
        'nom' => $faker->name('Bandi' | 'Wisky' | 'Boundty' | 'Happy'),
        'sexe' => 'Mâl',
        'race' => 'Non communiqué',
        'age' => 0,
        'discipline' => 'Non communiqué',
        'visuel' => '',
        'proprietaire_id' => 0,
        'animal_types_id' => 0
    ];
});
