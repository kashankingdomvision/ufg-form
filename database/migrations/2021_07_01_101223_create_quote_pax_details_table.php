<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotePaxDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_pax_details', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('quote_id')->constrained('quotes')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('nationality_id')->nullable()->constrained('countries')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('resident_in')->nullable()->constrained('countries')->onUpdate('cascade')->onDelete('restrict');
            $table->string('full_name')->nullable();
            $table->string('email_address')->nullable();
            $table->string('contact_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('bedding_preference')->nullable();
            $table->string('dietary_preferences')->nullable();
            $table->string('medical_requirement')->nullable();
            $table->enum('covid_vaccinated', [0, 1, 2])->default(0);
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
        Schema::dropIfExists('quote_pax_details');
    }
}
