<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDuepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duepayments', function (Blueprint $table) {
            $table->id();
            $table->date('payment_date');
            $table->biginteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->float('pre_due');
            $table->float('due_payment');
            $table->float('total');
            $table->integer('created_by');
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
        Schema::dropIfExists('duepayments');
    }
}
