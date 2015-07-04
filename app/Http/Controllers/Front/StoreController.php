<?php

namespace CodeCommerce\Http\Controllers\Front;

use CodeCommerce\Category;
use CodeCommerce\Product;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class StoreController extends Controller
{
    private $categoryModel;
    private $productModel;

    /**
     * @param Category $category
     * @param Product $product
     */
    public function __construct(Category $category, Product $product)
    {
        $this->categoryModel = $category;
        $this->productModel = $product;
    }

    public function index()
    {
        $featured = $this->productModel->Featured()->get();
        $recommended = $this->productModel->Recommended()->get();
        $categories = $this->categoryModel->all();

        return view('store.index', compact('categories', 'featured', 'recommended'));
    }
}
