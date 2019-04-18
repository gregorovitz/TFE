<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteEventinterne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::dropIfExists('interne_has_partenaire');
      Schema::dropIfExists('interne_has_user');
      Schema::dropIfExists('partenaires');
      Schema::dropIfExists('eventintern');
      Schema::dropIfExists('secteur');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('secteur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('eventintern', function (Blueprint $table) {
            $table->increments('id');
            $table->string('programme');
            $table->string('evaluation');
            $table->string('age');
            $table->string('participant');
            $table->integer('budget');
            $table->unsignedInteger('secteurId');
            $table->unsignedInteger('eventId');
            $table->foreign('eventId')
                ->references('id')
                ->on ('events');
            $table->foreign('secteurId')
                ->references('id')
                ->on('secteur');
            $table->timestamps();
        });
        Schema::create('partenaires', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('interne_has_partenaire', function (Blueprint $table) {
            $table->unsignedInteger('partenaireId');
            $table->unsignedInteger('interneId');
            $table->foreign('partenaireId')
                ->references('id')
                ->on('partenaires');
            $table->foreign('interneId')
                ->references('id')
                ->on('eventintern');
            $table->primary('partenaireId','interneId');

            $table->timestamps();
        });

    }
}
