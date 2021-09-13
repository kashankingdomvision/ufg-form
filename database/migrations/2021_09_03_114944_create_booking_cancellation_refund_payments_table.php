<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingCancellationRefundPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_cancellation_refund_payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('booking_id');
            $table->double('refund_amount')->nullable();
            $table->date('refund_date')->nullable();
            $table->date('refund_approved_date')->nullable();
            $table->unsignedBigInteger('refund_approved_by')->nullable();
            $table->unsignedBigInteger('refund_processed_by')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('refund_approved_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('refund_processed_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('booking_cancellation_refund_payments');
    }
}
