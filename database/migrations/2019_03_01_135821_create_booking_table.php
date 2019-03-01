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
        Schema::create('Booking', function (Blueprint $table) {
            $table->increments('id');
            $table->float('amount');
            $table->float('guarantee');
            $table->timestamps();
        });
        Schema::create('User_has_Booking',function(Blueprint $table){
            $table->unsignedInteger('bookingId');
            $table->unsignedInteger('userId');
            $table->foreign('bookingId')
                ->references('id')
                ->on('Booking');
            $table->foreign('userId')
                ->references('id')
                ->on('users');
            $table->primary(['bookingId','userId']);
        });
        Schema::create ('Booking_has_Room_has_Event',function(Blueprint $table){
            $table->unsignedInteger('bookingId');
            $table->unsignedInteger('roomId');
            $table->unsignedInteger('eventsId');
            $table->foreign('bookingId')
                ->references('id')
                ->on('Booking');
            $table->foreign('roomId')
                ->references('id')
                ->on('Room');
            $table->foreign('eventsId')
                ->references('id')
                ->on('Events');
            $table->primary(['bookingId','RoomId','eventsId']);
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
        Schema::dropIfExists('booking_has_room_has_event');
        Schema::dropIfExists('booking');
    }
}
