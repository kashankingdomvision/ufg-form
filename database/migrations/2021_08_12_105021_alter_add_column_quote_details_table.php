<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnQuoteDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_details', function (Blueprint $table) {
            $table->unsignedBigInteger('package_key')->after('quote_id')->nullable();
            $table->foreign('package_key')->references('id')->on('quote_detial_packages')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_details', function (Blueprint $table) {
            $table->dropColumn('package_key');
        });
    }
}
