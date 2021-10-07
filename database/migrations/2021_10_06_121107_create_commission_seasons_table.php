<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_criteria_seasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commission_criteria_id');
            $table->unsignedBigInteger('season_id');

            $table->foreign('season_id')->references('id')->on('seasons')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('commission_criteria_id')->references('id')->on('commission_criterias')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('commission_seasons');
    }
}
