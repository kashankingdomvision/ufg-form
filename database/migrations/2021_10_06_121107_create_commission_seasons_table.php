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
            $table->foreignId('commission_criteria_id')->constrained('commission_criterias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('season_id')->constrained('seasons')->onUpdate('cascade')->onDelete('cascade');
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
