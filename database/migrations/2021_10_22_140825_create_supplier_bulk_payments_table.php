<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierBulkPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_bulk_payments', function (Blueprint $table) {
            $table->id();
            $table->double('total_paid_amount');
            $table->double('current_credit_amount');
            $table->double('remaining_credit_amount');
            $table->date('payment_date')->nullable();
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('currency_id');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('supplier_bulk_payments');
    }
}
