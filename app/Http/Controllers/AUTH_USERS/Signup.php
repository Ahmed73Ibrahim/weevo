<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Http\Requests\Signup_req;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Signup extends Controller
{
    public function __construct() {  $this->middleware('auth:api', ['except' => ['Signup']]); }

    public function Signup(Signup_req $req){

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
