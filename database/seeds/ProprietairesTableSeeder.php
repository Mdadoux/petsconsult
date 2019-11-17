<?php

use Illuminate\Database\Seeder;

class ProprietairesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //lancer le script des seeds
        factory('App\Proprietaire', 5)->create();
    }
}
