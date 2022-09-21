<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(){
        
        return Inertia::render('admin/list-category', [
            'categories' => fn() => Category::all(),
        ]);
    }

    protected function categoryValidate(Request $request){
        $validation = [
            'name'=>'required|string',
            'description'=> 'string|nullable',
        ];

        //If it's an update there is no way that the slug is not going to be in the database
        if(!isset($request->category) || $request->slug != $request->category->slug){
            $validation['slug'] = 'required|string|unique:categories';
        }else{
            $validation['slug'] = 'required|string';
        }

        return $request->validate($validation);
    }

    public function store(Request $request){
        $data = $this->categoryValidate($request);
        $category = new Category;
        $category->fill($data);
        if($category->save()) return response()->json(['category' => $category]);
        return response()->json([ 'error' => 'Something Bad happened'])->status(500);
    }

    public function update(Category $category, Request $request){
        $category->fill($this->categoryValidate($request));

        if($category->save()) return Redirect::route('category.index');
        return response()->json([ 'error' => 'Something Bad happened'])->status(500);
    }
}
