<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingCreditNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_credit_notes', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('booking_detail_id');
            $table->foreign('booking_detail_id')->references('id')->on('booking_details')->onUpdate('cascade')->onDelete('cascade');
            $table->double('credit_note_amount')->nullable();
            $table->string('credit_note_no')->nullable();
            $table->date('credit_note_recieved_date')->nullable();
            $table->foreignId('credit_note_recieved_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('currency_id')->constrained('currencies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('booking_credit_notes');
    }
}
