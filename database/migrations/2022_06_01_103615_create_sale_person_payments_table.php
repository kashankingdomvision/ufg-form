<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalePersonPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_person_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_person_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sale_person_currency_id')->constrained('currencies')->onUpdate('cascade')->onDelete('cascade');
            $table->double('balance_owed_amount', 8, 2);
            $table->double('balance_owed_outstanding_amount', 8, 2);
            $table->double('balance_owed_total_paid_amount', 8, 2);
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
        Schema::dropIfExists('sale_person_payments');
    }
}
