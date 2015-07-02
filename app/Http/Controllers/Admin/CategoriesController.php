<?php

namespace CodeCommerce\Http\Controllers\Admin;

use CodeCommerce\Category;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    private $categoryModel;

    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $categories = $this->categoryModel->all();
        $categories = $this->categoryModel->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\CategoryRequest $request)
    {
        $inputs = $request->all();
        $category = $this->categoryModel->fill($inputs);
        $category->save();

        return redirect()->route('admin.categories');
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
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryModel->find($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\CategoryRequest $request, $id)
    {
        $this->categoryModel->find($id)->update($request->all());

        return redirect()->route('admin.categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->categoryModel->find($id)->delete();

        return redirect()->route('admin.categories');
    }
}
