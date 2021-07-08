<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('access_token');
            $table->string('refresh_token');
            $table->enum('type', ['zoho', 'tas'])->nullable()->default('zoho');
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
        Schema::dropIfExists('reference_credentials');
    }
}
