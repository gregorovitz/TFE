<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterneHasPartenaire extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interne_has_partenaire');
    }
}
