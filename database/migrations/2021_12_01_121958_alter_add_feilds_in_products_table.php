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
            
            $table->unsignedBigInteger('category_id')->after('name')->nullable(); 
            $table->unsignedBigInteger('country_id')->after('category_id')->nullable(); 
            $table->unsignedBigInteger('location_id')->after('country_id')->nullable(); 
            $table->unsignedBigInteger('currency_id')->after('location_id')->nullable(); 
            $table->unsignedBigInteger('booking_type_id')->after('currency_id')->nullable();
            $table->double('duration')->after('booking_type_id')->nullable();
            $table->double('price')->after('duration')->nullable();  
            
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('booking_type_id')->references('id')->on('booking_types')->onUpdate('cascade')->onDelete('cascade');
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
