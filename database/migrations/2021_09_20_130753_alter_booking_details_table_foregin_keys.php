<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBookingDetailsTableForeginKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_details', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('booked_by_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('booking_type_id')->references('id')->on('booking_types')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('supervisor_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('booking_method_id')->references('id')->on('booking_methods')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('supplier_currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('restrict');
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
            $table->dropForeign(['quote_id','supplier_id','category_id','booked_by_id','booking_type_id','supervisor_id','booking_method_id','supplier_currency_id']);
        });
    }
}
