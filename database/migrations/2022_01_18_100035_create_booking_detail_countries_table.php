<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDetailCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_detail_countries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('booking_detail_id');
            $table->unsignedBigInteger('country_id');

            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('booking_detail_id')->references('id')->on('booking_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_detail_countries');
    }
}
