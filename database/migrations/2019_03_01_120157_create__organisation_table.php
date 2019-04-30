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
        Schema::create('Organisations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('Organisation_has_user', function (Blueprint $table) {
            $table->unsignedInteger('organisationId');
            $table->unsignedInteger('userId');
            $table->foreign('organisationId')
                ->references('id')
                ->on('Organisations');
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
        Schema::dropIfExists('organisations');

    }
}
