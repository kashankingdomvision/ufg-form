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
            $table->unsignedBigInteger('commission_group_id');
            $table->string('booking_details');
            $table->string('reason_for_trip');
            $table->string('ref_name');
            $table->string('ref_no');
            $table->string('quote_ref');
            $table->string('tas_ref')->nullable();
            $table->enum('agency', [0, 1])->default(0);
            $table->enum('agency_commission_type',['net-price','paid-net-of-commission','we-pay-commission-on-departure'])->nullable();
            $table->double('agency_commission')->nullable();
            $table->double('total_net_margin')->nullable();
            $table->string('agency_name')->nullable();
            $table->string('agency_contact')->nullable();
            $table->string('agency_email')->nullable();
            $table->string('agency_contact_name')->nullable();
            $table->string('lead_passenger_name')->nullable();
            $table->string('lead_passenger_email')->nullable();
            $table->string('lead_passenger_contact')->nullable();
            $table->string('lead_passenger_dbo')->nullable();
            $table->enum('lead_passenger_covid_vaccinated',[0, 1, 2])->default(0);
            $table->unsignedBigInteger('lead_passsenger_nationailty_id')->nullable();
            $table->unsignedBigInteger('lead_passenger_resident')->nullable();
            $table->string('lead_passenger_dinning_preference')->nullable();
            $table->string('lead_passenger_bedding_preference')->nullable();
            $table->bigInteger('pax_no')->default(0);
            $table->double('net_price')->nullable();
            $table->double('markup_amount')->nullable();
            $table->double('markup_percentage')->nullable();
            $table->double('selling_price')->nullable();
            $table->double('profit_percentage')->nullable();
            $table->double('commission_amount')->nullable();
            $table->double('commission_percentage')->nullable();
            $table->string('selling_currency_oc')->nullable();
            $table->double('selling_price_ocr')->nullable();
            $table->double('amount_per_person')->nullable();
            $table->enum('rate_type',['live','manual'])->default('live');
            $table->enum('markup_type', ['itemised', 'whole'])->default('itemised');
            $table->enum('booking_status',['quote','booked','cancelled'])->default('quote');
            $table->enum('is_archive',[1,0])->default(0);
            $table->dateTime('booking_date')->nullable();
            $table->text('revelant_quote')->nullable();
            $table->string('stored_text')->nullable();
            $table->softDeletes();
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
