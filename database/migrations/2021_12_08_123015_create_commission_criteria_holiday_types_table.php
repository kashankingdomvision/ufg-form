<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionCriteriaHolidayTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_criteria_holiday_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commission_criteria_id');
            $table->unsignedBigInteger('holiday_type_id');
          
            $table->foreign('commission_criteria_id')->references('id')->on('commission_criterias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('holiday_type_id')->references('id')->on('holiday_types')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('commission_criteria_holiday_types');
    }
}
