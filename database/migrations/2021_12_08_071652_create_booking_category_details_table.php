<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingCategoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_category_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')->constrained('bookings')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('booking_detail_id')->constrained('booking_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onUpdate('cascade')->onDelete('restrict');

            $table->string('type')->nullable();
            $table->string('label')->nullable();
            $table->string('value')->nullable();
            $table->enum('multiple', ['true' , 'false']);

            $table->string('data')->nullable();
            $table->enum('inline', ['true' , 'false']);
            $table->mediumInteger('min')->nullable();
            $table->mediumInteger('max')->nullable();
            $table->string('subtype')->nullable();
            $table->enum('toggle', ['true' , 'false']);
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
        Schema::dropIfExists('booking_category_details');
    }
}
