<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
             'name'=>'required|unique:categories',
             'image'=>'required',
        ];
    }
    public function messages(){
        return [
            'name.required'=>'Category Name Include Par',
            'name.unique'=>'Category Include Pe Tar',
            'image.required'=>'Category for photo include par'

        ];
    }
}
