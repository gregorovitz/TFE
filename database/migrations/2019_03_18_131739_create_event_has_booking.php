<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventHasBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('event_has_booking', function (Blueprint $table) {
            $table->unsignedInteger('eventId');
            $table->unsignedInteger('bookingId');
            $table->foreign('eventId')
                ->references('id')
                ->on('events');
            $table->foreign('bookingId')
                ->references('id')
                ->on('bookings');
            $table->primary('eventId','bookingId');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('event_has_booking');
    }
}
