<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierBulkPaymentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_bulk_payment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_bulk_payment_id');
            $table->unsignedBigInteger('booking_id');
            $table->string('bd_reference_id', 6);
            $table->double('actual_cost');
            $table->double('outstanding_amount_left');
            $table->double('row_total_paid_amount');
            $table->double('paid_amount');
            $table->double('credit_note_amount');
            $table->unsignedBigInteger('currency_id');

            $table->foreign('supplier_bulk_payment_id')->references('id')->on('supplier_bulk_payments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('bd_reference_id')->references('id')->on('booking_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('supplier_bulk_payment_details');
    }
}
