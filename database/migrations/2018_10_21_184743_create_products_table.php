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
            $table->integer('product_id')->unsigned(); // идентификатор товара в markethot.ru
            $table->integer('amount'); // количество всех вариаций
            $table->integer('total')->default(0); // общее количество продукта
            $table->decimal('price', 8, 2); // минимальная цена товара
            $table->string('title'); // название товара
            $table->string('image')->nullable(true); // ссылка на изображение
            $table->text('description')->nullable(true); // описание товара
            $table->string('url')->nullable(true); // ссылка на товар на markethot.ru
            $table->datetime('first_invoice')->nullable(true); // дата первой продажи товара
            $table->timestamps(); // даты создания и редактирования

            $table->primary('product_id'); // Делаем поле первичным ключём, так как стандартный мы исключили
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
