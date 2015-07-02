<?php

namespace CodeCommerce\Http\Controllers\Admin;

use CodeCommerce\Category;
use CodeCommerce\Product;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class ProductsController extends Controller
{
    private $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $products = $this->productModel->all();
        $products = $this->productModel->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Category $category
     * @return Response
     */
    public function create(Category $category)
    {
        $categories = $category->lists('name', 'id');

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\ProductRequest $request
     * @return Response
     */
    public function store(Requests\ProductRequest $request)
    {
//        dd($request->all());
        $inputs = $request->all();
        $product = $this->productModel->fill($inputs);
        $product->save();

        return redirect()->route('admin.products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @param  int $id
     * @return Response
     */
    public function edit(Category $category, $id)
    {
        $categories = $category->lists('name', 'id');
        $product = $this->productModel->find($id);

        return view('admin.products.edit', compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\ProductRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(Requests\ProductRequest $request, $id)
    {
        $this->productModel->find($id)->update($request->all());

        return redirect()->route('admin.products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->productModel->find($id)->delete();

        return redirect()->route('admin.products');
    }
}
