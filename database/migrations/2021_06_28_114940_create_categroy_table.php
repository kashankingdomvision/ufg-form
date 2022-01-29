<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategroyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->mediumInteger('sort_order');
            $table->string('slug');
            $table->longText('feilds')->nullable();
            // $table->enum('booking', [0, 1])->default(0)->nullable();
            // $table->enum('quote', [0, 1])->default(0)->nullable();
            $table->enum('set_end_date_of_service', [0, 1])->default(0);
            $table->enum('show_tf', [0, 1])->default(0);
            $table->string('label_of_time')->nullable();

            $table->enum('second_tf', [0, 1])->default(0);
            $table->string('second_label_of_time')->nullable();

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
        Schema::dropIfExists('categories');
    }
}
