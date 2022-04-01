<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('product_coad')->nullable()->unique();
            $table->string('image')->nullable();
            $table->longText('slider_image')->nullable();
            $table->string('vedio')->nullable();
            $table->longText('small_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->biginteger('brand')->nullable()->unsigned();
            $table->foreign('brand')->references('id')->on('brands')->onDelete('cascade');
            $table->biginteger('unit')->nullable()->unsigned();
            $table->foreign('unit')->references('id')->on('units')->onDelete('cascade');
            $table->float('mrp')->nullable();
            $table->float('buy_price')->nullable();
            $table->float('sell_price')->nullable();
            $table->float('qty')->nullable();
            $table->biginteger('shop_type')->nullable()->unsigned();
            $table->foreign('shop_type')->references('id')->on('shop_categories')->onDelete('set null');
            $table->biginteger('subcategory')->nullable()->unsigned();
            $table->foreign('subcategory')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->string('slug');
            $table->integer('status')->default(0); //0=deactive 1=active
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
        Schema::dropIfExists('products');
    }
}
