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
            $table->foreignId('booking_id')->constrained('bookings')->onUpdate('cascade')->onDelete('cascade');
            $table->double('refund_amount')->nullable();
            $table->date('refund_date')->nullable();
            $table->date('refund_approved_date')->nullable();
            $table->foreignId('refund_approved_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('refund_processed_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('bank_id')->nullable()->constrained('banks')->onUpdate('cascade')->onDelete('cascade');
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
