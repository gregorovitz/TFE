<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('communication')->nullable();
            $table->float('total')->nullable();
            $table->unsignedInteger('organisationId');
            $table->unsignedInteger('eventId');
            $table->boolean('payement')->default(0);
            $table->boolean('validate')->default(0);
            $table->timestamps();
            $table->foreign('organisationId')
                ->references('id')
                ->on('organisations');
            $table->foreign('eventId')
                ->references('id')
                ->on('events');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_booking');
        Schema::dropIfExists('booking_has_event');
        Schema::dropIfExists('bookings');
    }
}
