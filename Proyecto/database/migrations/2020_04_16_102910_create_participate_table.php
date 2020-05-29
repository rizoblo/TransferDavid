<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_league');
            $table->unsignedBigInteger('id_team');
            $table->integer('pj');
            $table->integer('v');
            $table->integer('e');
            $table->integer('d');
            $table->integer('gf');
            $table->integer('gc');
            $table->integer('dg');
            $table->integer('points');
            $table->timestamps();
            $table->foreign('id_league')->references('id')->on('leagues');
            $table->foreign('id_team')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participates');
    }
}
