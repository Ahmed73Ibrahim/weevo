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
            'pass' => 'required|min:8',
            'type' => 'required|between:0,1|integer',

        ];
    }
}
