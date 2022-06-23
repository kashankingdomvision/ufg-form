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

            $table->id();
            $table->foreignId('booking_detail_id')->constrained('booking_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->onUpdate('cascade')->onDelete('cascade');
            $table->double('deposit_amount')->nullable();
            $table->date('deposit_due_date')->nullable();
            $table->date('paid_date')->nullable();
            $table->enum('upload_to_calender', [0,1])->default(0)->nullable();
            $table->enum('added_in_sage', [0, 1])->default(0)->nullable();
            $table->bigInteger('additional_date')->nullable();
            $table->double('outstanding_amount')->nullable();
            $table->enum('status', ['paid','cancelled'])->default('paid');
            $table->foreignId('currency_id')->constrained('currencies')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('booking_detail_finances');
    }
}
