<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleAgentCommissionBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sac_batches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sale_person_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sale_person_currency_id')->constrained('currencies')->onUpdate('cascade')->onDelete('cascade');
            $table->double('sp_deposit_amount', 8, 2)->nullable();
            $table->double('total_pay_commission_amount', 8, 2);
            $table->double('booking_commission_total_paid_amount', 8, 2)->nullable();
            $table->double('bank_total_amount_paid', 8, 2)->nullable();
            $table->double('total_paid_amount', 8, 2);
            $table->double('total_outstanding_amount', 8, 2);
            $table->enum('status', ['pending' , 'paid', 'partial', 'confirmed', 'disputed'])->default('pending');
            $table->date('sp_deposit_date')->nullable();
            $table->date('sp_deposit_paid_date')->nullable();
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
        Schema::dropIfExists('sale_agent_commission_batches');
    }
}
