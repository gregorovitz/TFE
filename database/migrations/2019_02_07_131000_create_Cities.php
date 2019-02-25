<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cities', function (Blueprint $table) {
            $table->increments('cityId');
            $table->timestamps();
            $table->integer('zipCode');
            $table->string('name',200);
            $table->string('provinces',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('Cities');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
