<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToFunctionTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('function_token', function (Blueprint $table) {
            $table->foreign('id_token')->references('id')->on('token');
            $table->foreign('id_function')->references('id')->on('function');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('function_token', function (Blueprint $table) {
            $table->dropForeign('function_token_id_token_foreign');
            $table->dropForeign('function_token_id_function_foreign');
        });
    }
}
