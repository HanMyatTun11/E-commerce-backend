<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $cats=Category::all();
        return view('category.index',compact('cats'));
    }


    public function create()
    {
        return view('category.create');
    }


    public function store(CategoryCreateRequest $request)
    {
        //dd($request->all());
        //image uploads
        $file=$request->file('image');
        $imageFile=uniqid()."_".$file->getClientOriginalName();
        $file->move(public_path().'/uploads/',$imageFile );

        $cat=new Category();
        $cat->name=$request->input('name');
        $cat->image=$imageFile;

        if($cat->save()){
            return redirect()->route('cats.index');
        }else{
            return redirect()->back('error',"Category Insert Error");
        }
    }


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category,$id)
    {
        $category=Category::find($id);
        return view('category.edit',compact('category'));
    }


    public function update(Request $request, Category $category,$id)
    {
        //dd($id);
        $validate=$request->validate([
            'name'=>'required'
        ]);
        if($validate){
            $category=Category::find($id);
            $category->name=$request->input('name');
            if($request->hasFile('image')){
                $file=$request->file('image');
                $imageFile=uniqid()."_".$file->getClientOriginalName();
                $file->move(public_path().'/uploads/',$imageFile );
                //set update photo
                $category->image=$imageFile;
            }

            //image update sucessful
            if($category->update()){
                return redirect()->route('cats.index');
            }else{
                return redirect()->back('error','Image Upload not success');
            }
        }


    }

    public function destroy(Category $category,$id)
    {
       //dd($id);
       $category=Category::find($id);
       $category->delete();
       return redirect()->route('cats.index');
    }
}
