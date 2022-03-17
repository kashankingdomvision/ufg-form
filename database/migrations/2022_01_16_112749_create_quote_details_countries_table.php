<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteDetailsCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_detail_countries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('quote_id');
            $table->unsignedBigInteger('quote_detail_id');
            $table->unsignedBigInteger('country_id');

            $table->foreign('quote_id')->references('id')->on('quotes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('quote_detail_id')->references('id')->on('quote_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_details_countries');
    }
}

// $table->primary(['quote_id', 'quote_detail_id','country_id']);
// $table->timestamps();