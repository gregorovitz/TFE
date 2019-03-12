<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterneHasUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interne_has_user', function (Blueprint $table) {
            $table->unsignedInteger('userId');
            $table->unsignedInteger('interneId');
            $table->foreign('userId')
                ->references('id')
                ->on('users');
            $table->foreign('interneId')
                ->references('id')
                ->on('eventintern');
            $table->primary('userId','interneId');

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
        Schema::dropIfExists('interne_has_user');
    }
}
