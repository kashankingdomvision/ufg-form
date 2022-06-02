<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddFeildsInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            
            $table->foreignId('category_id')->nullable()->after('name')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('country_id')->nullable()->after('category_id')->constrained('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('location_id')->nullable()->after('country_id')->constrained('locations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('currency_id')->nullable()->after('location_id')->constrained('currencies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('booking_type_id')->nullable()->after('currency_id')->constrained('booking_types')->onUpdate('cascade')->onDelete('cascade');
            $table->double('duration')->after('booking_type_id')->nullable();
            $table->double('price')->after('duration')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
