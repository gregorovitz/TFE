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
            $table->string('name');
            $table->float('amount')->nullable();
            $table->float('guarantee')->nullable();
            $table->unsignedInteger('userId');
            $table->timestamps();
            $table->foreign('userId')
                ->references('id')
                ->on('users');
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
