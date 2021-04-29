<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->nullable()->default('pending');
            $table->boolean('paid')->default(0);
            $table->decimal('price',6,2)->unsigned();
            $table->decimal('shipment_fees',6,2)->unsigned()->nullable(); //
            $table->decimal('discount',6,2)->unsigned()->nullable(); //
            $table->decimal('net_price',6,2)->unsigned(); // used if coupon code exists
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('area')->nullable();
            $table->string('country')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->mediumText('notes')->nullable();
            $table->string('reference_id')->nullable()->deafult(0);
            $table->string('payment_method')->nullable();

            $table->string('day')->nullable();
            $table->time('time')->nullable();
            $table->dateTime('booked_at')->nullable();

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

            $table->boolean('pickup_from_branch')->default(0);

            $table->integer('branch_id')->unsigned()->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('restrict');

            $table->integer('coupon_id')->unsigned()->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
