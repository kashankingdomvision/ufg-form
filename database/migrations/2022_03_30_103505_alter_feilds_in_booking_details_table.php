<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFeildsInBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_details', function (Blueprint $table) {

            $table->string('tour_meeting_point')->nullable()->after('product_details');
            $table->string('tour_contact')->nullable()->after('tour_meeting_point');
            $table->string('tour_telephone')->nullable()->after('tour_contact');
            $table->string('tour_address')->nullable()->after('tour_telephone');
            $table->foreignId('group_owner_id')->after('supplier_country_ids')->nullable()->constrained('group_owners')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_details', function (Blueprint $table) {
            //
        });
    }
}
