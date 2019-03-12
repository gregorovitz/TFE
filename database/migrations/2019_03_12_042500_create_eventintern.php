<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventIntern extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventintern', function (Blueprint $table) {
            $table->increments('id');
            $table->string('programme');
            $table->string('evaluation');
            $table->string('age');
            $table->string('participant');
            $table->integer('budget');
            $table->unsignedInteger('secteurId');
            $table->unsignedInteger('eventId');
            $table->foreign('eventId')
                ->references('id')
                ->on ('events');
            $table->foreign('secteurId')
                ->references('id')
                ->on('secteur');
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
        Schema::dropIfExists('eventintern');
    }
}
