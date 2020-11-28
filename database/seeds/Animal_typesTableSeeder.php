<?php

use Illuminate\Database\Seeder;

class Animal_typesTbaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory('App\Animal_type', 2)->create();
    }
}