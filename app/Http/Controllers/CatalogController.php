<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostCatalogSearchRequest;

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
    public function search(PostCatalogSearchRequest $request)
    {
        $data = $request->validated();
        $search = $data['search'];
        $type = $data['type'];

        $products = ($type == 0 ? Product::searchByTitle($search) : Product::searchByDescription($search));

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
        $result = array('products' => array(), 'category_name' => $category);
        $category = Category::getCategory($category);

        if (isset($category))
        {
            $result = array(
                'products' => $category->products,
                'category_name' => $category->title
            );
        }

        return view('catalog.category', $result);
    }
}
