<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddStatusInBookingDetailFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_detail_finances', function (Blueprint $table) {
            $table->enum('status',['paid','cancelled'])->default('paid')->after('outstanding_amount');
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
             $table->dropColumn('status');
        });
    }
}
