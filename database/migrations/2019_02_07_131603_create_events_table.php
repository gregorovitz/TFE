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
        Schema::create('Events', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('events_name');
            $table->integer('numPeopleExp');
            $table->Json('numPeopleActuCame')->nullable();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('daysofweek')->nullable();
            $table->time('startime');
            $table->time('endtime');
            $table->string('color')->default('orange');
        });
        Schema::create('TypeEvents',function (Blueprint $table){
           $table->increments('id');
           $table->string('name');
           $table->timestamps();
        });
        Schema::create('Events_has_Types',function (Blueprint $table){
            $table->unsignedInteger('EventsId');
            $table->unsignedInteger('TypeEventsId');

            $table->foreign('EventsId')
                ->references('id')
                ->on('Events');
            $table->foreign('TypeEventsId')
                ->references('id')
                ->on('TypeEvents');
            $table->primary(['EventsId','TypeEventsId']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events_has_types');
        Schema::dropIfExists('typeevents');
        Schema::dropIfExists('events');
    }
}
