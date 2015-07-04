<?php

namespace CodeCommerce\Http\Controllers\Admin;

use CodeCommerce\Category;
use CodeCommerce\Product;
use CodeCommerce\ProductImage;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $product = $this->productModel->find($id);

        if (count($product->images) > 0) {
            $images = $product->images->lists('name')->toArray();

            Storage::disk('public')->delete($images);
        }

        $product->delete();

        return redirect()->route('admin.products');
    }

    /**
     * @param $id
     * @return Response
     */
    public function images($id)
    {
        $product = $this->productModel->find($id);

        return view('admin.products.images.index', compact('product'));
    }

    /**
     * @param $id
     * @return Response
     */
    public function createImage($id)
    {
        $product = $this->productModel->find($id);

        return view('admin.products.images.create', compact('product'));
    }

    /**
     * @param Requests\ProductImageRequest $request
     * @param $id
     * @param ProductImage $productImage
     * @return Response
     */
    public function storeImage(Requests\ProductImageRequest $request, $id, ProductImage $productImage)
    {
//        dd($request->file('image'));
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mime = $file->getClientMimeType();
        $size = $file->getClientSize();

        $newName = md5(explode('.'.$extension, $name)[0].'_'.time()).'.'.$extension;

        $productImage::create([
            'name'=>$newName,
            'extension'=>$extension,
            'mime'=>$mime,
            'size'=>$size,
            'product_id'=>$id
        ]);

        Storage::disk('public')->put($newName, File::get($file));

        return redirect()->route('admin.products.images', ['id'=>$id]);
    }

    /**
     * @param ProductImage $productImage
     * @param $id
     * @return Response
     */
    public function destroyImage(ProductImage $productImage, $id)
    {
        $image = $productImage->find($id);

        if (file_exists(public_path('uploads').'/'.$image->name)) {
            Storage::disk('public')->delete($image->name);
        }

        $product = $image->product;
        $image->delete();

        return redirect()->route('admin.products.images', ['id'=>$product->id]);
    }
}
