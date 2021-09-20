<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDetailFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_detail_finances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_detail_id');
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->double('deposit_amount')->nullable();
            $table->date('deposit_due_date')->nullable();
            $table->date('paid_date')->nullable();
            $table->enum('upload_to_calender', [0,1])->default(0)->nullable();
            $table->bigInteger('additional_date')->nullable();
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('booking_detail_id')->references('id')->on('booking_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_detail_finances');
    }
}
