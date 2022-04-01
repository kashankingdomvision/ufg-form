<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTemplateDetailsTableForeginKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_details', function (Blueprint $table) {
            $table->foreign('template_id')->references('id')->on('templates')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('booking_type_id')->references('id')->on('booking_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supplier_currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_details', function (Blueprint $table) {
            $table->dropForeign([
                'template_id',
                'category_id',
                'supplier_id',
                'product_id',
                'booking_type_id',
                'supplier_currency_id',
            ]);
        });
    }
}

// $table->foreign('booked_by_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
// $table->foreign('supervisor_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
// $table->foreign('booking_method_id')->references('id')->on('booking_methods')->onUpdate('cascade')->onDelete('cascade');