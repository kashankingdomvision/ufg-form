<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlertAddForeignKeyUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('holiday_type_id')->references('id')->on('holiday_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('commission_id')->references('id')->on('commissions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('commission_group_id')->references('id')->on('commission_groups')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id', 'currency_id', 'supervisor_id', 'holiday_type_id', 'brand_id']);
        });
    }
}