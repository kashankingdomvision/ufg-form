<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddFeildsInSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {

            $table->unsignedBigInteger('group_owner_id')->after('location_id')->nullable(); 
            $table->string('code')->after('group_owner_id')->nullable(); 
            $table->double('commission_rate')->after('description')->nullable(); 
            
            $table->foreign('group_owner_id')->references('id')->on('group_owners')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropForeign(['group_owner_id', 'code', 'commission_rate']);
        });
    }
}
