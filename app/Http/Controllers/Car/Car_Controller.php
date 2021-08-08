<?php
namespace App\Http\Controllers\Car;
use App\Http\Controllers\Controller;
use App\Models\Car;
 use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Car_Controller extends Controller
{
    public function __construct() {  $this->middleware('auth:api', ['except' => ['list_car']]); }

    public function list_car(){

        return response()->json(['success' => Car::get() ], 201);
    }

   
 
   }
