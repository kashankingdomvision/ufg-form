<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddTemplateTableColumnBookingCurrencyId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('templates', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_currency_id')->after('season_id');
            $table->foreign('booking_currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('templates', function (Blueprint $table) {
            $table->dropForeign(['booking_currency_id']);
            $table->dropColumn('booking_currency_id');
        });
    }
}
