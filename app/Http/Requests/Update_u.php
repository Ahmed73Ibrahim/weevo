<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class Update_u extends FormRequest
{
    public function authorize() {  return true; } 
    public function rules()
    {
        return 
        [
                'id' =>'required|integer|exists:Users',      
                'first_name' => 'min:3|max:20|string',
                'last_name' => 'min:3|max:20|string',
                'email' => 'unique:Users|email:rfc,dns',
                'phone' => 'unique:Users|numeric|regex:/(01)\d{9}/|digits:11',
                'type' => 'integer|between:1,3', 
        ];
    }
}