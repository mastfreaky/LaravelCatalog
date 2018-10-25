<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Implements Product model.
 */
class Product extends Model
{
    /**
     * Override Eloquent default primary key properties
     */
    protected $primaryKey = 'product_id';

    /**
     * Override Eloquent default primary key properties
     */
    public $incrementing = false;

    /**
     * Get populat products.
     *
     * @param  integer $count
     *
     * @return array
     */
    public static function popular($count)
    {
        return Product::orderBy('total', 'DESC')->limit($count)->get();
    }

    
    /**
     * Get the product by product_id
     *
     * @param  integer $product_id
     *
     * @return object
     */
    public static function findByProductId($product_id)
    {
        return self::where('product_id', $product_id)->first();
    }

    /**
     * Search products by part of title.
     *
     * @param  string $title
     *
     * @return array
     */
    public static function searchByTitle($title)
    {
        return self::where('title', 'LIKE', "%$title%")->get();
    }

    /**
     * Search products by part of description.
     *
     * @param  string $description
     *
     * @return array
     */
    public static function searchByDescription($description)
    {
        return self::where('description', 'LIKE', "%$description%")->get();
    }

    /**
     * Get the categories.
     *
     * @return array
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    /**
     * Get the offers.
     *
     * @return array
     */
    public function offers()
    {
        return $this->hasMany(Offer::class, 'product_id', 'product_id');
    }
}
