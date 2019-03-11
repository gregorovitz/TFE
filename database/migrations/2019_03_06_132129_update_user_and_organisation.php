<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserAndOrganisation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function($table){
            $table->unsignedInteger('organisationId')->default(1);
            $table->foreign('organisationId')
                ->references('id')
                ->on ('organisations');
        });
        Schema::dropIfExists('organisation_has_user');
        Schema::dropIfExists('organisation_has_type');
        Schema::table('organisations',function($table){
            $table->unsignedInteger('typeOrganisationId')->default=(1);
            $table->foreign('typeOrganisationId')
                ->references('id')
                ->on ('typeorganisations');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function(Blueprint $table){
            $table->dropForeign('users_organisationid_foreign');
            $table->dropColumn('organisationId');
        });
        Schema::table('organisations',function(Blueprint $table){
            $table->dropForeign('organisations_typeorganisationid_foreign');
            $table->dropColumn('typeOrganisationId');
        });
    }
}
