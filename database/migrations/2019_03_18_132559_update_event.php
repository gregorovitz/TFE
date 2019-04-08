<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events',function($table){
            $table->dropForeign(['bookingid']);
            $table->dropForeign(['typeeventsid']);
            $table->dropColumn('bookingId');
            $table->dropColumn('typeEventsId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events',function($table){
            $table->unsignedInteger('typeEventsId');
            $table->unsignedInteger('bookingId');

        });
    }
}
