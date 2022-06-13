<?php

use App\Package;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('price')->nullable();
            $table->integer('taxes')->nullable();
            $table->tinyInteger('points');
            $table->string('image')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
        });

        Package::create([
            'name' => 'پنل پیامک انبوه',
            'url' => 'homePage/sms',
            'price' => '25000',
            'points' => '3',
            'image' => '/upload/category/966smsPackage.png',
        ]);

        Package::create([
            'name' => 'کارت تخفیف',
            'url' => 'homePage/discountCart',
            'price' => '25000',
            'points' => '2',
            'image' => '/upload/category/739discountCart.png',
        ]);

        Package::create([
            'name' => 'کارت ویزیت الکترونیک',
            'url' => 'خالی',
            'price' => '25000',
            'points' => '2',
            'image' => '/upload/category/955visitPackage.png',
        ]);

        Package::create([
            'name' => 'کتابخانه مجازی',
            'url' => 'homePage/library',
            'price' => '25000',
            'points' => '4',
            'image' => '/upload/category/599library.png',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pckages');
    }
}
