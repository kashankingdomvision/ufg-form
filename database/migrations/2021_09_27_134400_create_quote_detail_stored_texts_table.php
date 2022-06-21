<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteDetailStoredTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_detail_stored_texts', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('quote_detail_id')->constrained('quote_details')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('stored_text')->nullable();
            $table->date('action_date')->nullable();
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
        Schema::dropIfExists('quote_detail_stored_texts');
    }
}
