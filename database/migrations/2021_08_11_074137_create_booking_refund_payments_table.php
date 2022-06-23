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
            
            $table->id();
            $table->foreignId('booking_detail_id')->constrained('booking_details')->onUpdate('cascade')->onDelete('cascade');
            $table->double('refund_amount')->nullable();
            $table->date('refund_date')->nullable();
            $table->foreignId('refund_confirmed_by')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('bank_id')->constrained('banks')->onUpdate('cascade')->onDelete('restrict');
            $table->enum('refund_recieved', [0,1])->default(0)->nullable();
            $table->date('refund_recieved_date')->nullable();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('currency_id')->constrained('currencies')->onUpdate('cascade')->onDelete('restrict');
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
