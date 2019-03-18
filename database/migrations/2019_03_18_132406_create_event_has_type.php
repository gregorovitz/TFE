<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventHasType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_has_type', function (Blueprint $table) {
            $table->unsignedInteger('eventId');
            $table->unsignedInteger('typeId');
            $table->foreign('eventId')
                ->references('id')
                ->on('events');
            $table->foreign('typeId')
                ->references('id')
                ->on('typeevents');
            $table->primary('eventId','bookingId');
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
        Schema::dropIfExists('event_has_type');
    }
}
