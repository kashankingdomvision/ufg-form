<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingRefundPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_refund_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_detail_id');
            $table->double('refund_amount')->nullable();
            $table->date('refund_date')->nullable();
            $table->unsignedBigInteger('refund_confirmed_by');
            $table->unsignedBigInteger('bank_id');
            $table->enum('refund_recieved', [0,1])->default(0)->nullable();
            $table->date('refund_recieved_date')->nullable();
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('booking_detail_id')->references('id')->on('booking_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('refund_confirmed_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('booking_refund_payments');
    }
}
