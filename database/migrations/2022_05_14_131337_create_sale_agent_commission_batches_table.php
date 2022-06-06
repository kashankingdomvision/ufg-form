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
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('sale_person_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('sale_person_currency_id')->constrained('currencies')->onUpdate('cascade')->onDelete('restrict');
            $table->double('total_paid_amount', 8, 2);
            $table->double('total_outstanding_amount', 8, 2);
            $table->enum('status', ['pending' , 'paid', 'partial', 'confirmed', 'disputed'])->default('pending');
            $table->date('deposit_date')->nullable();
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
