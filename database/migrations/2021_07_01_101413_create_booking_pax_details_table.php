<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingPaxDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_pax_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_id');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('bedding_preference')->nullable();
            $table->string('dinning_preference')->nullable();
            $table->timestamps();
            
            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_pax_details');
    }
}
