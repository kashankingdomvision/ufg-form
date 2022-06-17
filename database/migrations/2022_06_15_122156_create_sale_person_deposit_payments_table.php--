<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalePersonDepositPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_person_deposit_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sac_batch_id')->nullable()->constrained('sac_batches')->onUpdate('cascade')->onDelete('cascade');
            $table->double('total_deposited_amount', 8, 2);
            $table->double('current_deposited_total_outstanding_amount', 8, 2);
            $table->double('total_deposited_outstanding_amount', 8, 2);
            $table->double('total_deposit_amount', 8, 2);
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
        Schema::dropIfExists('sale_person_deposit_payments');
    }
}
