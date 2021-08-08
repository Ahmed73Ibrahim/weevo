<?php
namespace App\Http\Controllers\Location;
use App\Http\Controllers\Controller;
use App\Http\Requests\Signup_req;
use App\Models\City;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Map extends Controller
{
    public function __construct() {  $this->middleware('auth:api', ['except' => ['list_gover','list_city']]); }

    public function list_gover(){

        return response()->json(['success' => Governorate::get() ], 201);
    }

    public function list_city(Request $req){

        $req->validate(['gover_id' => 'required|integer|exists:Governorates,id']);

        return response()->json(['success' => City::where('gover_id',$req->gover_id)->get() ], 201);
    }


    public function gover(Signup_req $req){
       
        $c_rec="";

        if($req->type == 2){
             $req->validate(['c_rec' => 'required|string']);
             $c_rec=$req->c_rec;
             }



        $user = User::create([
            'name' => $req->name,
            'pass' => Hash::make($req->pass),
            'phone' => $req->phone,
            'type' => $req->type,
            'c_req'=> $c_rec ,
            'created_at'=>now()
           ]);

       return response()->json(['success' => 'Welcome to Weevo'], 201);
      }
   }
