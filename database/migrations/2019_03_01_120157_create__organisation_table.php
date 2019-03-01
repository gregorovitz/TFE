<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::create('Organisation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('TypeOrganisation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('Organisation_has_Type', function (Blueprint $table) {
            $table->unsignedInteger('organisationId');
            $table->unsignedInteger('typeOrganisationId');
            $table->foreign('organisationId')
                ->references('id')
                ->on('Organisation');
            $table->foreign('typeOrganisationId')
                ->references('id')
                ->on('TypeOrganisation');
            $table->primary(['organisationId','typeOrganisationId']);
        });
        Schema::create('Organisation_has_user', function (Blueprint $table) {
            $table->unsignedInteger('organisationId');
            $table->unsignedInteger('userId');
            $table->foreign('organisationId')
                ->references('id')
                ->on('Organisation');
            $table->foreign('userId')
                ->references('id')
                ->on('users');
            $table->primary(['organisationId','userId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_has_user');
        Schema::dropIfExists('organisation_has_type');
        Schema::dropIfExists('organisation');
        Schema::dropIfExists('typeorganisation');
    }
}
