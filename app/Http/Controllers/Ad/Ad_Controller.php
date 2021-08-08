<?php
namespace App\Http\Controllers\Ad;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ad_req;
use App\Models\Ad;
use Illuminate\Http\Request;

class Ad_Controller extends Controller  # CRUD  C=Store
{
    public function __construct() {  $this->middleware('auth:api', ['except' => [] ]); }

    public function store(Ad_req $req){

        $details = "";

        if($req->details)
        {
            $req->validate(['details' => 'string|min:15|max:500']);
            $details=$req->details;
        }
        $user = auth()->user() ; 

        $ad = Ad::create([


            'title' => $req->title,
            'ad_type' => $req->ad_type,
            'price' => $req->price,
            'distance' => $req->distance,
            'car_img' => $req->car_img,
            'state' => $req->state,
            'guarantee' => $req->guarantee,
            'car_id' => $req->car_id,
            'user_id' => $user->id,
            'user_id' => $user->id,
            'details' => $details,
            'created_at'=>now()

        ]);

        return response()->json(['success' => $ad  ], 201);
    }  
   }
