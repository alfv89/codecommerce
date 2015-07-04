<?php

namespace CodeCommerce\Http\Controllers\Admin;

use CodeCommerce\Tag;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class TagsController extends Controller
{
    private $tagModel;

    /**
     * @param Tag $tagModel
     */
    public function __construct(Tag $tagModel)
    {
        $this->tagModel = $tagModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tags = $this->tagModel->paginate(10);

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\TagRequest $request
     * @return Response
     */
    public function store(Requests\TagRequest $request)
    {
        $inputs = $request->all();
        $tag = $this->tagModel->fill($inputs);
        $tag->save();

        return redirect()->route('admin.tags');
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
        $tag = $this->tagModel->find($id);

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\TagRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(Requests\TagRequest $request, $id)
    {
        $this->tagModel->find($id)->update($request->all());

        return redirect()->route('admin.tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->tagModel->find($id)->delete();

        return redirect()->route('admin.tags');
    }
}
