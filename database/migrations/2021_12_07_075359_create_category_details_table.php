<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryDetailsTable extends Migration
{
// type
// label
// value
// multiple
// data
// inline
// min
// max
// subtype
// toggle
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_category_details', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('quote_id')->constrained('quotes')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('quote_detail_id')->constrained('quote_details')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('category_id')->constrained('categories')->onUpdate('cascade')->onDelete('restrict');

            $table->string('type')->nullable();
            $table->string('label')->nullable();
            $table->string('value')->nullable();
            $table->enum('multiple', ['true' , 'false']);

            $table->string('data')->nullable();
            $table->enum('inline', ['true' , 'false']);
            $table->mediumInteger('min')->nullable();
            $table->mediumInteger('max')->nullable();
            $table->string('subtype')->nullable();
            $table->enum('toggle', ['true' , 'false']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_details');
    }
}
