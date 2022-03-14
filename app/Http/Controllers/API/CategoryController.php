<?php

namespace App\Http\Controllers\API;

use Validator;
use Illuminate\Http\Request;
use App\Models\Shop\Category;
use Illuminate\Support\Str as Str;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::with('product')->get();
        return response()->json($category, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'        => 'required|string|max:180'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $category = Category::Create([
            'name'          => $request->name,
            'slug'          => Str::slug($request->slug),
            'description'   => $request->description,
        ]);

        return response()->json($category, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(),[
            'name'        => 'required|string|max:180'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $category->update($request->all());
        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json($category, 200);
    }
}
