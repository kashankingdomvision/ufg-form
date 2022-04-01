<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
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
        Schema::dropIfExists('commissions');
    }
}


// $table->double('percentage');

// $table->unsignedBigInteger('commission_group_id');
// $table->foreign('commission_group_id')->references('id')->on('commission_groups')->onUpdate('cascade')->onDelete('cascade');

// $table->unsignedBigInteger('brand_id');
// $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade')->onDelete('cascade');

// $table->unsignedBigInteger('holiday_type_id');
// $table->foreign('holiday_type_id')->references('id')->on('holiday_types')->onUpdate('cascade')->onDelete('cascade');

// $table->unsignedBigInteger('currency_id');
// $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');