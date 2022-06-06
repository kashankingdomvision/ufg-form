<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDetailCancellationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_detail_cancellations', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('booking_detail_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('cancelled_by_id')->constrained('booking_details')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('booking_detail_cancellations');
    }
}
