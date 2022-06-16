<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleAgentCommissionBatchTransDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sac_batch_trans_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sac_batch_id')->nullable()->constrained('sac_batches')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('type', ['deposit' , 'booking_commission']);
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
        Schema::dropIfExists('sale_agent_commission_batch_trans_details');
    }
}
