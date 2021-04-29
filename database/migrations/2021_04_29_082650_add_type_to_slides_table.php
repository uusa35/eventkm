<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->string('module')->nullable();
            $table->integer('category_id')->unsigned()->index()->nullable();
            $table->integer('product_id')->unsigned()->index()->nullable();
            $table->integer('service_id')->unsigned()->index()->nullable();
            $table->integer('user_id')->unsigned()->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn('module');
            $table->dropColumn('category_id');
            $table->dropColumn('product_id');
            $table->dropColumn('service_id');
            $table->dropColumn('user_id');
        });
    }
}
