<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCat;
use Illuminate\Http\Request;

class SubCatController extends Controller
{

    public function index($id)
    {
      $cat=Category::with('subcats')->find($id);
      return view('subcat.index',compact('cat'));
      //dd($cat->toArray());
    }


    public function create($id)
    {
      $cat=Category::find($id);
      return view('subcat.create',compact('cat'));
    }


    public function store(Request $request,$id)
    {
       //dd($request->all());
       $file=$request->file('image');
       $imageFile=uniqid()."_".$file->getClientOriginalName();
       $file->move(public_path().'/uploads/',$imageFile );

       $cat=new SubCat();
       $cat->Category_id=$id;
       $cat->name=$request->input('name');
       $cat->image=$imageFile;

       if($cat->save()){
           return redirect()->route('cat.sub.index',$id);
       }else{
           return redirect()->back('error',"SubCategory Insert Error");
       }
    }


    public function show(SubCat $subCat)
    {

    }


    public function edit(SubCat $subCat,$id)
    {
        $category=SubCat::find($id);
        return view('subcat.edit',compact('category'));
    }


    public function update(Request $request, SubCat $subCat,$id)
    {
        $validate=$request->validate([
            'name'=>'required'
        ]);
        if($validate){
            $category=SubCat::find($id);
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
                return redirect()->route('cat.sub.index',$category->category_id);
            }else{
                return redirect()->back('error','Image Upload not success');
            }
        }
    }


    public function destroy(SubCat $subCat,$id)
    {
        $cat=SubCat::find($id);
        $cat->delete();
        return redirect()->route('cat.sub.index',$cat->category_id);
    }
}
