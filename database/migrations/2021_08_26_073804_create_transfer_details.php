<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_detail_id');
            $table->foreign('booking_detail_id')->references('id')->on('booking_details')->onUpdate('cascade')->onDelete('cascade');
            $table->string('transfer_description')->nullable();
            $table->integer('quantity')->nullable();

            $table->string('pickup_port')->nullable();
            $table->string('pickup_accomodation')->nullable();
            $table->date("pickup_date")->nullable();
            $table->time("pickup_time")->nullable();

              
            $table->string('dropoff_port')->nullable();
            $table->string('dropoff_accomodation')->nullable();
            $table->date("dropoff_date")->nullable();
            $table->time("dropoff_time")->nullable();
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
        Schema::dropIfExists('transfer_details');
    }
}
