<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccomodationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accomodation_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_detail_id');
            $table->foreign('booking_detail_id')->references('id')->on('booking_details')->onUpdate('cascade')->onDelete('cascade');
            $table->string('accomadation_name')->nullable();
            $table->date('arrival_date')->nullable();
            $table->integer('no_of_nights')->nullable();
            $table->integer('no_of_rooms')->nullable();
            $table->string('room_types')->nullable();
            $table->string('meal_plan')->nullable();
            $table->string('refrence')->nullable();
            $table->enum('day_event',[1,0])->nullable();
            $table->enum('confirmed_with_supplier',[1,0,2])->nullable();
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
        Schema::dropIfExists('accomodation_details');
    }
}
