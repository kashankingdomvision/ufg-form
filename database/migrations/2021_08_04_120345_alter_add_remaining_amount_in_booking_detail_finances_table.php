<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddRemainingAmountInBookingDetailFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_detail_finances', function (Blueprint $table) {
            $table->double('outstanding_amount')->nullable()->after('additional_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_detail_finances', function (Blueprint $table) {
            $table->dropColumn('outstanding_amount');
        });
    }
}
