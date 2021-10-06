<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('total_net_price')->default(0);
            $table->double('total_markup_amount')->default(0);
            $table->double('total_markup_percentage')->default(0);
            $table->double('total_selling_price')->default(0);
            $table->double('total_profit_percentage')->default(0);
            $table->double('total_commission_amount')->default(0);
            $table->string('currency_id')->nullable();
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
        Schema::dropIfExists('groups');
    }
}
