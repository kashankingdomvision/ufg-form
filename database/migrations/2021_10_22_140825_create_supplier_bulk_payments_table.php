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
            $table->foreignId('supplier_id')->constrained('suppliers')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('season_id')->constrained('seasons')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('currency_id')->constrained('currencies')->onUpdate('cascade')->onDelete('restrict');
            $table->double('total_paid_amount');
            $table->double('current_credit_amount');
            $table->double('remaining_credit_amount');
            $table->double('total_used_credit_amount');
            $table->date('payment_date')->nullable();
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
