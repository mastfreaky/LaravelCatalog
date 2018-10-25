<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->nullable(true); // идентификатор категории в markethot.ru
            $table->integer('parent')->unsigned()->nullable(true); // родительская категория(у категорий есть иерархия)
            $table->string('title'); // название категории
            $table->string('alias'); // текстовая метка(SLUG) категории(можно использовать в качестве пути для ссылки на категорию)
            $table->timestamps();

            $table->primary('category_id'); // Делаем поле как первычный ключ для того, чтобы на него могло ссылаться поле parent
            $table->foreign('parent')->references('category_id')->on('categories'); // внешний ключ для поля parent - связь один ко многим(у каждой категории может быть несколько подкатегорий) - с этой же таблицей
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
