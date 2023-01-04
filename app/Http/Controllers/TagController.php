<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index()
    {
        $tags=Tag::all();
        return view('tag.index',compact('tags'));
    }


    public function create()
    {
        return view('tag.create');
    }


    public function store(CategoryCreateRequest $request)
    {
        //dd($request->all());
         //image uploads
         $file=$request->file('image');
         $imageFile=uniqid()."_".$file->getClientOriginalName();
         $file->move(public_path().'/uploads/',$imageFile );

         $cat=new Tag();
         $cat->name=$request->input('name');
         $cat->image=$imageFile;

         if($cat->save()){
             return redirect()->route('tags.index');
         }else{
             return redirect()->back('error',"Tag Insert Error");
         }
    }


    public function show(Tag $tag)
    {
        //
    }


    public function edit($id)
    {
        $tag=Tag::find($id);
        return view('tag.edit',compact('tag'));
        //dd($id);
    }


    public function update(Request $request,$id)
    {
        //dd($id);
        $validate=$request->validate([
            'name'=>'required'
        ]);
        if($validate){
            $tag=Tag::find($id);
            $tag->name=$request->input('name');
            if($request->hasFile('image')){
                $file=$request->file('image');
                $imageFile=uniqid()."_".$file->getClientOriginalName();
                $file->move(public_path().'/uploads/',$imageFile );
                //set update photo
                $tag->image=$imageFile;
            }

            //image update sucessful
            if($tag->update()){
                return redirect()->route('tags.index');
            }else{
                return redirect()->back('error','Image Upload not success');
            }
        }
    }


    public function destroy($id)
    {
        //dd($id);
        $tag=Tag::find($id);
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
