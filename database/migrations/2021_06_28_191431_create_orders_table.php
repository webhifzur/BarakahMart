<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('billing_id')->unsigned();
            $table->foreign('billing_id')->references('id')->on('billings')->onDelete('cascade');
            $table->bigInteger('shipping_id')->unsigned();
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('cascade');
            $table->string('subtotal');
            $table->string('shipping');
            $table->string('total');
            $table->string('pay_type');
            $table->integer('payment_status');
            $table->string('tracking_code');
            $table->string('note')->nullable();
            $table->integer('status')->default(0); //0=pendding,1=processing,2=delevered,3=cancel
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
