<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleAgentCommissionBatchDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sac_batch_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sac_batch_id')->constrained('sac_batches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('booking_id')->constrained('bookings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sales_agent_default_currency_id')->constrained('currencies')->onUpdate('cascade')->onDelete('cascade');

            $table->double('commission_amount_in_default_currency', 8, 2);
            $table->double('total_paid_amount_yet', 8, 2);
            $table->double('outstanding_amount_left', 8, 2);
            $table->double('pay_commission_amount', 8, 2);
            $table->double('total_paid_amount', 8, 2);
            $table->double('total_outstanding_amount', 8, 2);
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
        Schema::dropIfExists('sale_agent_commission_batch_details');
    }
}
