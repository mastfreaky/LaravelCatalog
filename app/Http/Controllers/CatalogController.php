<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;

/**
 * Implements Catalog Controller.
 */
class CatalogController extends Controller
{
    /**
     * Get main catalog page. 
     *
     * @return mixed
     */
    public function index()
    {
        return view('catalog.index', [
            'categories' => Category::with('children')->get(),
            'products' => Product::popular(20)
        ]);
    }

    /**
     * Search products.
     *
     * @return mixed
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');
        $products = array();
        if (isset($search))
        {
            $products = $type == 0 ? Product::searchByTitle($search) : Product::searchByDescription($search);
        }

        return view('catalog.search_result', [
            'products' => $products
        ]);
    }

    /**
     * Get products by category.
     *
     * @param  string $category
     *
     * @return mixed
     */
    public function category($category)
    {
        $category = Category::getCategory($category);

        return view('catalog.category', [
            'products' => $category->products,
            'category_name' => $category->title
        ]);
    }
}
