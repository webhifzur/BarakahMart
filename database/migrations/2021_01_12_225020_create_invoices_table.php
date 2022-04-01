<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date');
            $table->integer('customer_type');
            $table->biginteger('customer_id')->nullable()->unsigned();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('set null');
            $table->string('customer_phone')->nullable();
            $table->float('subTotal');
            $table->float('pre_ammount');
            $table->float('total');
            $table->float('cash');
            $table->float('return_taka');
            $table->float('due');
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
        Schema::dropIfExists('invoices');
    }
}
