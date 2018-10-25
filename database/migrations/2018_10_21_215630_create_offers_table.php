<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->integer('offer_id')->unsigned(); // идентификатор вариации в markethot.ru(например iphone 6 64gb черный - вариация товара iphone 6)
            $table->integer('product_id')->unsigned(); // идентификатор продукта из таблицы products
            $table->integer('amount')->nullable(true); // количество вариации товара на складе
            $table->integer('sales')->nullable(true); // товаров продано
            $table->decimal('price', 8, 2)->nullable(true); // цена вариации
            $table->string('article')->nullable(true); // артикул вариации
            $table->timestamps();

            $table->primary('offer_id'); // Делаем поле первичным ключём, так как стандартный мы исключили
            $table->foreign('product_id')->references('product_id')->on('products'); //  внешний ключ для product_id - связь один ко многим(один продукт и много вариаций) с таблицей products
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
