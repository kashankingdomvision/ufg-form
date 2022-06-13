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

            $table->foreignId('group_owner_id')->after('name')->nullable()->constrained('group_owners')->onUpdate('cascade')->onDelete('restrict');
            $table->string('contact_person')->after('group_owner_id')->nullable(); 
            $table->string('code')->after('contact_person')->nullable(); 
            $table->double('commission_rate')->after('code')->nullable(); 
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

            $table->dropForeign([
                'group_owner_id',
            ]);

            $table->dropColumn([
                'group_owner_id'
            ]);
        });
    }
}
