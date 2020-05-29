<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_team_local');
            $table->unsignedBigInteger('id_team_visitor');
            $table->unsignedBigInteger('id_league');
            $table->integer('journey');
            $table->integer('score_local');
            $table->integer('score_visitor');
            $table->timestamps();
            $table->foreign('id_team_local')->references('id')->on('teams');
            $table->foreign('id_team_visitor')->references('id')->on('teams');
            $table->foreign('id_league')->references('id')->on('leagues');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
