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
            $table->foreignId('quote_id')->constrained('quotes')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('quote_detail_id')->constrained('quote_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('countries')->onUpdate('cascade')->onDelete('restrict');
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