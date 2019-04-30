<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteTypeEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('event_has_type');
        Schema::dropIfExists('typeevents');
        Schema::table('events',function($table) {
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events',function($table) {
            $table->dropColumn('description');;
        });
        Schema::create('TypeEvents',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
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
}
