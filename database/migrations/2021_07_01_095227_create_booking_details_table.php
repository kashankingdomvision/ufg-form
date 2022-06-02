<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->string('booking_detail_unique_ref_id', 6)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('supplier_country_ids')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('booking_method_id')->nullable();
            $table->unsignedBigInteger('booked_by_id')->nullable();
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->unsignedBigInteger('supplier_currency_id')->nullable();
            $table->unsignedBigInteger('booking_type_id')->nullable();
            $table->double('refundable_percentage')->nullable();
            $table->date('date_of_service')->nullable();
            $table->date('end_date_of_service')->nullable();
            $table->integer('number_of_nights')->nullable();
            $table->time('time_of_service')->nullable();
            $table->time('second_time_of_service')->nullable();
            $table->date('booking_date')->nullable();
            $table->date('booking_due_date')->nullable();
            $table->text('service_details')->nullable();
            $table->string('booking_reference')->nullable();
            $table->text('comments')->nullable();
            $table->double('estimated_cost')->nullable();
            $table->double('actual_cost')->nullable();
            $table->double('markup_amount')->nullable();
            $table->double('markup_percentage')->nullable();
            $table->double('selling_price')->nullable();
            $table->double('profit_percentage')->nullable();
            $table->double('actual_cost_bc')->nullable();
            $table->double('selling_price_in_booking_currency')->nullable();
            $table->double('markup_amount_in_booking_currency')->nullable();
            $table->enum('added_in_sage', [0, 1])->default(0);
            $table->string('invoice')->nullable();
            $table->double('outstanding_amount_left', 8, 2)->nullable();
            $table->enum('status', ['not_booked', 'pending', 'booked', 'cancelled'])->default('not_booked');
            $table->enum('payment_status', ['active', 'cancelled'])->default('active');
            $table->longText('category_details')->nullable();
            $table->longText('product_details')->nullable();
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
        Schema::dropIfExists('booking_details');
    }
}

// $table->string('product_id')->nullable();

