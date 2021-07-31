<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Signup_ extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|min:3|max:20|string',
            'last_name' => 'required|min:3|max:20|string',
            'phone' => 'required|numeric|regex:/(01)\d{9}/|digits:11|unique:users',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:8',
            'gender' => 'required|between:1,2|integer',
            'photo' => 'required|string',
            'nid_back' => 'required|string',
            'nid_front' => 'required|string',
            'delivery_method' => 'required|between:1,5|integer',
            'vehicle_number' => 'required|integer',
            'vehicle_color' => 'required|integer',
            'vehicle_model' => 'required|string',
            'state_id' => 'required|string',
            'city_id' => 'required|string',
            'street' => 'required|string',
            'building_number' => 'required|integer',
            'floor' => 'required|integer',
            'apartment' => 'required|integer',
            'building_number' => 'required|integer',
        ];
    }
}
