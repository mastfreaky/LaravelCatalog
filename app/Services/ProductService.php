<?php

namespace App\Services;

use App\Category;
use App\Offer;
use App\Product;

/**
 * Implements product service. Parse API response. Create categories, products and offers.
 */
class ProductService
{
    /**
     * Create or update products, offers and categories.
     *
     * @param  object $rawData just parsed JSON to object with arrays
     *
     * @return void
     */
    public static function updateProducts($rawData)
    {
        // Я думаю, что удаление продуктов не требуется. Скорее всего, они вообще нигде не удаляются, а просто устанавливается количество в ноль.

        $rawObject = json_decode($rawData);

        if (isset($rawObject) && isset($rawObject->products) && is_array($rawObject->products))
        {
            foreach ($rawObject->products as $rawProduct)
            {
                $product = Product::findByProductId($rawProduct->id);
                if (!isset($product))
                {
                    $product = new Product();
                    $product->product_id = $rawProduct->id;
                }
                $product->amount = $rawProduct->amount;
                $product->price = $rawProduct->price;
                $product->title = $rawProduct->title;
                $product->image = $rawProduct->image;
                $product->description = $rawProduct->description;
                $product->first_invoice = $rawProduct->first_invoice;
                $product->url = $rawProduct->url;

                $product->save();

                // Вот тут интересный момент, который требует подробного изучения документации по API ресурса-базы. Дело в том, что не известно будут ли приходить офферы с нулевым amount. Если будут, то просто обновляем нужные значения. Если же нулевые не приходят, то нужно удалять все офферы каждый раз и заново создавать нужные - в этом случае блок с обновлением оффера можно убрать
                // $product->offers()->delete();

                // Обнуляем максимальное количество продуктов. Будем пересчитывать заново
                $product_total = 0;

                if (isset($rawProduct->offers) && is_array($rawProduct->offers))
                {
                    foreach ($rawProduct->offers as $rawOffer)
                    {
                        $offer = Offer::findByOfferId($rawOffer->id);
                        if (!isset($offer))
                        {
                            $offer = new Offer();
                            $offer->offer_id = $rawOffer->id;
                            $offer->product_id = $product->product_id;
                            $offer->amount = $rawOffer->amount;
                            $offer->sales = $rawOffer->sales;
                            $offer->price = $rawOffer->price;
                            $offer->article = $rawOffer->article;

                            $offer->save();
                        }
                        else
                        {
                            if ($offer->amount != $rawOffer->amount
                                || $offer->sales != $rawOffer->sales
                                || $offer->price != $rawOffer->price
                                || $offer->article != $rawOffer->article)
                            {
                                $offer->amount = $rawOffer->amount;
                                $offer->sales = $rawOffer->sales;
                                $offer->price = $rawOffer->price;
                                $offer->article = $rawOffer->article;

                                $offer->save();
                            }
                        }

                        // Считаем общее количество продукта по всем офферам. Это нужно для того, чтобы при загрузке популярных товаров не пересчитывать всё каждый раз заново
                        $product_total += $offer->amount;
                    }
                }

                $product->total = $product_total;

                $categoryIds = array();

                if (isset($rawProduct->categories) && is_array($rawProduct->categories))
                {
                    foreach ($rawProduct->categories as $rawCategory)
                    {
                        $category = Category::findByCategoryId($rawCategory->id);

                        if (!isset($category))
                        {
                            $category = new Category();
                            $category->category_id = $rawCategory->id;
                            $category->title = $rawCategory->title;
                            $category->alias = $rawCategory->alias;
                            $category->alias = $rawCategory->alias;
                            $category->parent = $rawCategory->parent;

                            $category->save();
                        }

                        array_push($categoryIds, $category->category_id);
                    }
                }

                // Категории перезаписываем полностью
                $product->categories()->sync($categoryIds);
                $product->save();
            }
        }

        echo 'DONE!';
    }
}