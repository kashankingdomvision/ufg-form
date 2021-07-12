<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('commission_id');
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('holiday_type_id');
            $table->unsignedBigInteger('sale_person_id');
            $table->string('ref_name');
            $table->string('ref_no');
            $table->string('quote_ref');
            $table->string('lead_passenger');
            $table->enum('agency', [0, 1])->default(0);
            $table->string('agency_name')->nullable();
            $table->string('agency_contact')->nullable();
            $table->string('dinning_preference');
            $table->string('bedding_preference');
            $table->bigInteger('pax_no')->default(1);
            $table->double('net_price')->nullable();
            $table->double('markup_amount')->nullable();
            $table->double('markup_percentage')->nullable();
            $table->double('selling_price')->nullable();
            $table->double('profit_percentage')->nullable();
            $table->double('commission_amount')->nullable();
            $table->string('selling_currency_oc')->nullable();
            $table->double('selling_price_ocr')->nullable();
            $table->double('amount_per_person')->nullable();
            $table->enum('rate_type',['live','manual'])->default('live');
            $table->enum('booking_status',['quote','booked'])->default('quote');
            $table->dateTime('booking_date')->nullable();
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
        Schema::dropIfExists('quotes');
    }
}
