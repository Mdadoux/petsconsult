<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //utilisation des factory pour creerles enregistrements des patients
        factory('App\User', 1)->create();
    }
}