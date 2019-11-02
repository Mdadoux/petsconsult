<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->enum('sexe', ['Mâl', 'Femelle'])->default('Mâl');
            $table->string('race')->nullable();
            $table->string('age')->nullable();
            $table->string('discipline')->nullable();
            $table->string('visuel')->nullable();
            $table->unsignedBigInteger('proprietaire_id')->default(0);
            $table->unsignedBigInteger('animal_types_id')->default(0);
            //$table->unsignedBigInteger('consultation_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
