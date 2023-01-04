<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'phone'=>'required|digits_between:7,11',
            'password'=>'required|min:8'
        ];
    }
    public function messages()
    {
        return[
           'phone.required'=>'Phone နံပါတ်မထည်လိုမရဘူးလေ',
           'phone.digits_between'=>'phone အနည်းဆူံး၇လူံးအများဆူံး၁၁လူံးထည်ပါ',
           'password.required'=>'Password နံပါတ်မထည်လိုမရဘူးလေ',
           'password.min'=>'password အနည်းဆူံး၈လူံးထည်ပါ'
        ];
    }
}
