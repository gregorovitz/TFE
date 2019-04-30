<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEventAddCommentaireOrganisation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events',function($table){
            $table->unsignedInteger('organisationId');
            $table->string('commentaire')->nullable();
            $table->boolean('payement');
            $table->foreign('organisationId')
                ->references('id')
                ->on ('organisations');
            $table->string('publicTypes');
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
            $table->dropForeign(['organisationId']);
            $table->dropColumn('organisationId');
            $table->dropColumn('commentaire');
            $table->dropColumn('payement');
            $table->dropColumn('publicTypes');
        });
    }
}
