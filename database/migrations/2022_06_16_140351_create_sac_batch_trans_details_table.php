<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSacBatchTransDetailsTable extends Migration
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
            $table->foreignId('sale_person_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('type', ['sac_batch_details', 'sale_person_payments']);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sac_batch_trans_details');
    }
}
