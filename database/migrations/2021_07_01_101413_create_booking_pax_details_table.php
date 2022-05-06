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
            
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onUpdate('cascade')->onDelete('cascade');
            $table->string('full_name')->nullable();
            $table->string('email_address')->nullable();
            $table->string('contact_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('bedding_preference')->nullable();
            $table->string('dietary_preferences')->nullable();
            $table->string('medical_requirement')->nullable();
            $table->enum('covid_vaccinated',[0, 1, 2])->default(0);
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
        Schema::dropIfExists('booking_pax_details');
    }
}
