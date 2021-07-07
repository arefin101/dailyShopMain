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
            $table->integer('productId')->primary();
            $table->string('productName');
            $table->string('description');
            $table->integer('categoryId')->unsigned();
            $table->foreign('categoryId')->references('categoryId')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('buyingPrice');
            $table->integer('sellingPrice');
            $table->integer('quantity');
            $table->string('picture');
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
        Schema::dropIfExists('products');
    }
}
