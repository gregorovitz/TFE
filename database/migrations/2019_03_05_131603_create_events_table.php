<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TypeEvents',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('Events', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('numPeopleExp');
            $table->Json('numPeopleActuCame')->nullable();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('daysofweek')->nullable();
            $table->time('startime');
            $table->time('endtime');
            $table->unsignedInteger('roomId');
            $table->unsignedInteger('typeEventsId');
            $table->unsignedInteger('userId');
            $table->unsignedInteger('bookingId');
            $table->string('color')->default('yellow');
            $table->foreign('roomId')
                ->references('id')
                ->on ('rooms');
            $table->foreign('typeEventsId')
                ->references('id')
                ->on('typeevents');
            $table->foreign('userId')
                ->references('id')
                ->on ('users');
            $table->foreign('bookingId')
                ->references('id')
                ->on ('bookings');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('typeevents');
    }
}
