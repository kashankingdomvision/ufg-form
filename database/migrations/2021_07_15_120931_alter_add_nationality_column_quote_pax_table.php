<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddNationalityColumnQuotePaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_pax_details', function (Blueprint $table) {
            $table->unsignedBigInteger('nationality_id')->after('quote_id')->nullable();
            $table->unsignedBigInteger('resident_in')->after('nationality_id')->nullable();
            $table->foreign('nationality_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('resident_in')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_pax_details', function (Blueprint $table) {
            $table->dropForeign('quote_pax_details_country_id_foreign');
            $table->dropColumn('country_id');
        });
    }
}
