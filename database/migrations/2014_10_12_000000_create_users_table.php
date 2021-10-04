<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('holiday_type_id')->nullable();
            $table->unsignedBigInteger('commission_id')->nullable();
            $table->unsignedBigInteger('commission_group_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('rate_type', ['live' , 'manual']);
            $table->enum('markup_type', ['itemised', 'whole'])->default('itemised');
            $table->rememberToken();
            $table->integer('is_login')->unsigned()->default(0);
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
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('users');
        // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
