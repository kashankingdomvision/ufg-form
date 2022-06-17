<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransDetailIdSacBatchDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sac_batch_details', function (Blueprint $table) {

            $table->foreignId('sac_batch_trans_detail_id')
            ->nullable()
            ->constrained('sac_batch_trans_details')
            ->onUpdate('cascade')
            ->onDelete('cascade')
            ->after('sac_batch_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
