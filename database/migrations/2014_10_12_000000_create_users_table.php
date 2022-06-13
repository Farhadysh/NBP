<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('nickname')->nullable();
            $table->enum('level', ['admin', 'visitor', 'user', 'seller', 'customer'])->default('user');
            $table->string('mobile')->unique();
            $table->string('email')->nullable();
            $table->string('password');
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->string('birth_date')->nullable();
            $table->string('national_code')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->bigInteger('bank_id')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('wallet')->default(0);
            $table->string('parent')->nullable();
            $table->boolean('best')->default(false);
            $table->rememberToken();
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
