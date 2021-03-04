<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStreetToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('block')->nullable();
            $table->string('street')->nullable();
            $table->string('building')->nullable();
            $table->string('floor')->nullable();
            $table->string('apartment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('block');
            $table->dropColumn('street');
            $table->dropColumn('building');
            $table->dropColumn('floor');
            $table->dropColumn('apartment');
        });
    }
}
