<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Implements Category model.
 */
class Category extends Model
{
    /**
     * Override Eloquent default primary key properties
     */
    protected $primaryKey = 'category_id';

    /**
     * Override Eloquent default primary key properties
     */
    public $incrementing = false;

    /**
     * Get category by alias.
     *
     * @param  string $category alias
     *
     * @return object
     */
    public static function getCategory($category)
    {
        return self::where('alias', $category)->first();
    }

    /**
     * Get category by category identifier(category_id)
     *
     * @param  mixed $category_id
     *
     * @return object
     */
    public static function findByCategoryId($category_id)
    {
        return self::where('category_id', $category_id)->first();
    }

    /**
     * Get all children categories.
     *
     * @return array
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent');
    }

    /**
     * Get all products of current category.
     *
     * @return array
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }
}
