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
            $table->integer('numMaxPeople');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status',['request','signature waiting','validate','pay']);
            $table->time('startime');
            $table->time('endtime');
            $table->string('color')->default('yellow');
            $table->string('url');
            $table->string('commentaire')->nullable();
            $table->string('publicTypes');
            $table->string('description');
            $table->string('communication')->nullable();
            $table->integer('tarif')->nullable();
            $table->unsignedInteger('roomId');
            $table->unsignedInteger('userId');
            $table->unsignedInteger('organisationId');

            $table->foreign('roomId')
                ->references('id')
                ->on ('rooms');
            $table->foreign('userId')
                ->references('id')
                ->on ('users');
            $table->foreign('organisationId')
                ->references('id')
                ->on ('organisations');
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
