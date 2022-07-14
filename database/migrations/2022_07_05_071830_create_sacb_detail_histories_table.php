<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSacbDetailHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sacb_detail_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sac_batch_id')->constrained('sac_batches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sac_batch_trans_detail_id')->nullable()->constrained('sac_batch_trans_details')->onUpdate('cascade')->onDelete('cascade');

            $table->foreignId('booking_id')->constrained('bookings')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('sale_person_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('sale_person_currency_id')->constrained('currencies')->onUpdate('cascade')->onDelete('restrict');

            $table->double('commission_amount_in_sale_person_currency', 8, 2);
            $table->double('total_paid_amount_yet', 8, 2);
            $table->double('outstanding_amount_left', 8, 2);
            $table->double('pay_commission_amount', 8, 2);
            $table->double('total_paid_amount', 8, 2);
            $table->double('total_outstanding_amount', 8, 2);
            $table->double('deposited_amount_value', 8, 2)->nullable();
            $table->double('bank_amount_value', 8, 2)->nullable();
            // $table->enum('status', ['pending' , 'confirmed', 'dispute', 'paid'])->default('pending');
            // $table->text('dispute_detail')->nullable();
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
        Schema::dropIfExists('sacb_detail_hitories');
    }
}
