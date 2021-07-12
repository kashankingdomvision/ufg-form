<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quote_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('booking_method_id')->nullable();
            $table->unsignedBigInteger('booked_by_id')->nullable();
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->unsignedBigInteger('supplier_currency_id')->nullable();
            $table->unsignedBigInteger('booking_type_id')->nullable();
            $table->date('date_of_service')->nullable();
            $table->time('time_of_service')->nullable();
            $table->date('booking_date')->nullable();
            $table->date('booking_due_date')->nullable();
            $table->text('service_details')->nullable();
            $table->string('booking_reference')->nullable();
            $table->text('comments')->nullable();
            $table->double('estimated_cost')->nullable();
            $table->double('markup_amount')->nullable();
            $table->double('markup_percentage')->nullable();
            $table->double('selling_price')->nullable();
            $table->double('profit_percentage')->nullable();
            $table->double('estimated_cost_bc')->nullable();
            $table->double('selling_price_bc')->nullable();
            $table->double('markup_amount_bc')->nullable();
            $table->enum('added_in_sage', [0, 1])->default(0);
            $table->timestamps();
            
            $table->foreign('quote_id')->references('id')->on('quotes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('booked_by_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('booking_method_id')->references('id')->on('booking_methods')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supplier_currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('booking_type_id')->references('id')->on('booking_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_details');
    }
}
