<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddFeildsIdInQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->unsignedBigInteger('commission_criteria_id')->nullable()->after('user_id');
            $table->foreign('commission_criteria_id')->references('id')->on('commission_criterias')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            
            $table->dropForeign([
                'commission_criteria_id',
            ]);

            $table->dropColumn([
                'commission_criteria_id'
            ]);
        });
    }
}
