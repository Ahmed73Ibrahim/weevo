<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Http\Requests\Signup_;
use App\Models\User;

class Add_user extends Controller
{
    public function __construct() {  $this->middleware('auth:api', ['except' => ['add_user']]); }

    public function add_user(Signup_ $req){
        $user = User::create([

            //'id' => $req->id,        [[[[ auto increment]]]]
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'password' => $req->password,
            'email' => $req->email,
            'phone' => $req->phone,
            'gender' => $req->gender,     // 1 = male , 2 = female
            'photo' => $req->photo,                ///
            'nid_back' => $req->nid_back,        ///
            'nid_front' => $req->nid_front,     ///
           /****************************************************************/
            'delivery_method'=> $req->delivery_method,         // 1 = car || 2 = 'motorbike',  3 = 'bicycle',  4=  'truck', 'none'
            'vehicle_number' => $req->vehicle_number,
            'vehicle_color' => $req->vehicle_color,
            'vehicle_model' => $req->vehicle_model,
            /****************************************************************/
            'state_id' =>   $req->state_id ,    // ???????????????????
            /****************************************************************/
            'city_id' => $req->city_id,
            'street' => $req->street,
            'building_number' => $req->building_number,
            'floor' => $req->floor,
            'apartment' => $req->apartment,     // shaka rkm
            /****************************************************************/
            // ' cities[0]' =>$req->vehicle_number,
            // ' cities[1]' =>$req->vehicle_number,
            'created_at'=>now()

           ]);

       return response()->json(['success' => 'joins ... Veevo'], 201);
      }
   }
