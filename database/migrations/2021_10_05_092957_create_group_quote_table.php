<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupQuoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_quote', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('groups')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('quote_id')->constrained('quotes')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('group_quote');
    }
}
