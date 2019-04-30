<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table){
            $table->dropForeign('users_organisationid_foreign');
            $table->dropColumn('organisationId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function($table){
            $table->unsignedInteger('organisationId')->default(1);
            $table->foreign('organisationId')
                ->references('id')
                ->on ('organisations');
        });
    }
}
