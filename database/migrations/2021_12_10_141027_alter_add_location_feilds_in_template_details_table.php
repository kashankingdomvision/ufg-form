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
            $table->foreignId('supplier_location_id')->nullable()->after('category_id')->constrained('locations')->onUpdate('cascade')->onDelete('restrict');
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

// $table->unsignedBigInteger('product_location_id')->after('supplier_id')->nullable(); 
// $table->foreign('product_location_id')->references('id')->on('locations')->onUpdate('cascade')->onDelete('cascade');