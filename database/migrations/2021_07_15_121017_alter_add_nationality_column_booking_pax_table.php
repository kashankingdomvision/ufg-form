<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddNationalityColumnBookingPaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_pax_details', function (Blueprint $table) {
            $table->foreignId('nationality_id')->after('booking_id')->nullable()->constrained('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('resident_in')->after('nationality_id')->nullable()->constrained('countries')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_pax_details', function (Blueprint $table) {
            $table->dropForeign('booking_pax_details_nationality_id_foreign');
            $table->dropColumn('nationality_id');
        });
    }
}
