<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionCriteriaCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_criteria_currencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commission_criteria_id');
            $table->unsignedBigInteger('currency_id');
          
            $table->foreign('commission_criteria_id')->references('id')->on('commission_criterias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('commission_criteria_currencies');
    }
}
