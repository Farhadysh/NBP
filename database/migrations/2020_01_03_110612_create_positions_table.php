<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->bigInteger('r_hand')->nullable();
            $table->bigInteger('l_hand')->nullable();
            $table->bigInteger('leftCount')->default(0);
            $table->bigInteger('rightCount')->default(0);
            $table->bigInteger('hand_id')->nullable();
            $table->string('visitor_code');
            $table->string('Reference_code')->nullable();
            $table->string('Consultant_code');
            $table->string('wallet')->default('0');
            $table->boolean('active')->default(false);
            $table->enum('position', ['آراد', 'آریامهر', 'آدر', 'ویدا', 'پرگاس', 'جاوید', 'کیان', 'هور', 'سورین', 'لرد'])->nullable();

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
        Schema::dropIfExists('positions');
    }
}
