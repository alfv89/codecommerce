<?php

namespace CodeCommerce\Http\Controllers\Front;

use CodeCommerce\Category;
use CodeCommerce\Product;
use CodeCommerce\Tag;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class StoreController extends Controller
{
    private $categoryModel;
    private $tagModel;
    private $productModel;

    /**
     * @param Category $category
     * @param Tag $tag
     * @param Product $product
     */
    public function __construct(Category $category, Tag $tag,Product $product)
    {
        $this->categoryModel = $category;
        $this->tagModel = $tag;
        $this->productModel = $product;
    }

    public function index()
    {
        $featured = $this->productModel->featured()->get();
        $recommended = $this->productModel->recommended()->get();
        $categories = $this->categoryModel->all();

        return view('store.index', compact('categories', 'featured', 'recommended'));
    }

    public function category($id)
    {
        $categories = $this->categoryModel->all();
        $category = $this->categoryModel->find($id);
        $products = $this->productModel->ofCategory($id)->get();

        return view('store.category', compact('categories', 'category', 'products'));
    }

    public function tag($id)
    {
        $categories = $this->categoryModel->all();
        $tag = $this->tagModel->find($id);
        $products = $tag->products()->get();
//        $products = $this->productModel->ofTag($id)->get();

        return view('store.tag', compact('categories', 'tag', 'products'));
    }

    public function product($id)
    {
        $categories = $this->categoryModel->all();
        $product = $this->productModel->find($id);

        return view('store.product', compact('categories', 'product'));
    }
}
