<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFixedShipmentChargeToCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->decimal('minimum_shipment_charge', 6, 2)->unsigned()->default(1)->change();
            $table->decimal('fixed_shipment_charge', 6, 2)->unsigned()->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('sale_minimum_shipment_charge');
            $table->dropColumn('fixed_shipment_charge');
        });
    }
}
