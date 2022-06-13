<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

            $table->bigInteger('address_id')->unsigned();
            $table->foreign('address_id')->references('id')
                ->on('addresses')->onDelete('cascade');

            $table->string('Authority');
            $table->string('RefID')->nullable();

            $table->tinyInteger('send_tpe')->comment('1 is sefareshi | 2 is pishtaz');
            $table->integer('send_price');

            $table->enum('status', ['init', 'success', 'failed'])->default('init');
            $table->enum('send_status', ['init', 'send', 'store', 'delivery'])->default('init');
            $table->boolean('clear')->default(false);
            $table->text('description')->nullable();

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
