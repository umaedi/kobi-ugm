<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Api as Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $categoryRespository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRespository = $categoryRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $result = $this->categoryRespository->getAll();
            return ($result);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->only('name'), [
            'name'  => 'required|unique:categories',
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        $name = $request->name;
        $name = Category::create([
            'name'  => $name,
            'slug'  => Str::slug($name)
        ]);
        if ($name) {
            return $this->sendResponseCreate($name);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cat = Category::findOrFail($request->id);
        $validator = Validator::make($request->only('name'), [
            'name'  => 'required|unique:categories',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $name = $request->name;
        $cat->where('id', $request->id)->update([
            'name'  => $name,
            'slug'  => Str::slug($name)
        ]);

        if ($cat) {
            return $this->sendResponseUpdate($cat);
        } else {
            return $this->sendResponseError($cat);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findorfail($id);
        $category->destroy($id);
    }
}
