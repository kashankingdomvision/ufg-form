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
            $table->foreignId('supplier_bulk_payment_id')->constrained('supplier_bulk_payments')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('booking_id')->constrained('brands')->onUpdate('cascade')->onDelete('restrict');
            $table->string('bd_reference_id', 6);
            $table->double('actual_cost');
            $table->double('outstanding_amount_left');
            $table->double('row_total_paid_amount');
            $table->double('paid_amount');
            $table->double('credit_note_amount');
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
        Schema::dropIfExists('supplier_bulk_payment_details');
    }
}

// $table->foreign('bd_reference_id')->references('id')->on('booking_details')->onUpdate('cascade')->onDelete('cascade');
