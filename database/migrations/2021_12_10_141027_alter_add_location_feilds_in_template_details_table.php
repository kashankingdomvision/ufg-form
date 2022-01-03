<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddLocationFeildsInTemplateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_details', function (Blueprint $table) {

            $table->unsignedBigInteger('supplier_location_id')->after('category_id')->nullable(); 
            // $table->unsignedBigInteger('product_location_id')->after('supplier_id')->nullable(); 

            $table->foreign('supplier_location_id')->references('id')->on('locations')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('product_location_id')->references('id')->on('locations')->onUpdate('cascade')->onDelete('cascade');
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
                'supplier_location_id',
                'product_location_id',
            ]);
        });
    }
}
