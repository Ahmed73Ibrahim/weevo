<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Signup_req extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
  
            'name' => 'required|min:3|max:100|string',
            'phone' => 'required|numeric|regex:/(01)\d{9}/|digits:11|unique:users',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:8',
            'type' => 'required|between:0,1|integer',
            'address' => 'required|string',
            'location' => 'required|between:1,5|integer',
            //'img_path' => 'required|string',
            //'c_rec' => 'required|string',

        ];
    }
}
