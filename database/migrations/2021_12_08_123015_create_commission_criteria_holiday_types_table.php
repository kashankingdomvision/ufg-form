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
            $table->foreignId('commission_criteria_id')->constrained('commission_criterias')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('holiday_type_id')->constrained('holiday_types')->onUpdate('cascade')->onDelete('restrict');
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
