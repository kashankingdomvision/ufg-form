<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDetailCancellationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_detail_cancellations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_detail_id');
            $table->unsignedBigInteger('cancelled_by_id');
            $table->foreign('cancelled_by_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('booking_detail_id')->references('id')->on('booking_details')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('booking_detail_cancellations');
    }
}
