<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterQuoteTableForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->foreign('commission_id')->references('id')->on('commissions')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('commission_group_id')->references('id')->on('commission_groups')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('default_supplier_currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('restrict');
            // $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('season_id')->references('id')->on('seasons')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('holiday_type_id')->references('id')->on('holiday_types')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('sale_person_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('sale_person_currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('lead_passsenger_nationailty_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('lead_passenger_resident')->references('id')->on('countries')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $columns = [ 
            'default_supplier_currency_id',
            'created_by',
            'user_id',
            'season_id',
            'brand_id',
            'currency_id',
            'holiday_type_id',
            'sale_person_id',
            'lead_passsenger_nationailty_id',
            'lead_passenger_resident'
        ];

        Schema::table('quotes', function (Blueprint $table) {
            $table->dropForeign($columns);
            $table->dropColumn($columns);
        });
    }
}
