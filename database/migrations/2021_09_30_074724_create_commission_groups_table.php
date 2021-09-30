<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_groups', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('commission_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->double('percentage');
            $table->foreign('commission_id')->references('id')->on('commissions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('commission_groups');
    }
}
