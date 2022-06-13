<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('code');
            $table->string('name');
            $table->string('slug');
            $table->integer('price');
            $table->integer('discount');
            $table->integer('production_price')->nullable();
            $table->integer('company_price');
            $table->integer('commission');
            $table->string('unit')->nullable();
            $table->string('telegram')->nullable();
            $table->string('instagram')->nullable();
            $table->integer('limit_weight');
            $table->integer('limit_count');
            $table->string('brand');
            $table->integer('sell_count')->default(0);
            $table->text('description')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('approved')->default(false);
            $table->tinyInteger('sendDay');
            $table->text('cause')->nullable();
            $table->bigInteger('buyCount')->default(0);
            $table->integer('viewCount')->default(0);
            $table->boolean('special')->default(false);
            $table->timestamps();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->primary(['category_id', 'product_id']);
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
