<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Ad_req extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|min:10|max:100|string',
            'ad_type' => 'required| boolean',
            'price' => 'required|integer',
            'distance' => 'required|integer',
            'car_img' => 'required|string',
            'state' => 'required|boolean',
            'guarantee' => 'required|boolean',
            'car_id' => 'required|integer|exists:Cars,id',
          //'details' => 'required|min:3|max:100|string',
        ];
    }
}
