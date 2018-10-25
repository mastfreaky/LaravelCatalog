<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->integer('category_id')->unsigned(); // идентификатор категории из таблицы categories
            $table->integer('product_id')->unsigned(); // идентификатор продукта из таблицы products

            $table->foreign('category_id')->references('category_id')->on('categories'); // внешний ключ для category_id - связь много ко многим(много продуктов и много категорий)
            $table->foreign('product_id')->references('product_id')->on('products'); // внешний ключ для product_id - связь много ко многим(много продуктов и много категорий)
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
    }
}
