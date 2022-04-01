<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->biginteger('city')->nullable()->unsigned();
            $table->foreign('city')->references('id')->on('cities')->onDelete('set null');
            $table->biginteger('area')->nullable()->unsigned();
            $table->foreign('area')->references('id')->on('areas')->onDelete('set null');
            $table->longText('address')->nullable();
            $table->longText('profile_img')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('type')->default(0); //customer = 0,Super admin = 1,admin =2,manager=3
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
