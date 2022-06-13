<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('booking_detail_id')->constrained('booking_details')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('supplier_id')->constrained('suppliers')->onUpdate('cascade')->onDelete('restrict');
            $table->double('amount');
            $table->enum('type',['credit','debit']);
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
        Schema::dropIfExists('booking_transactions');
    }
}
