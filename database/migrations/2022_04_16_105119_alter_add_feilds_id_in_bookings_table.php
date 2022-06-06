<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddFeildsIdInBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('commission_criteria_id')->nullable()->after('sale_person_id')->constrained('commission_criterias')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking', function (Blueprint $table) {
            
            $table->dropForeign([
                'commission_criteria_id',
            ]);

            $table->dropColumn([
                'commission_criteria_id'
            ]);
        });
    }
}
