<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Http\Requests\Update_u;
use App\Models\User;

class Update_user extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }
   
    public function update_user(Update_u $req)
    {       
        $user = User::where('id', $req->id)->first();

        if( $req->first_name && $req->last_name  )
        {             
            $user->update(['first_name'=>$req->first_name,'last_name'=>$req->last_name]);
        }

        if($req->type)  { $user->update(['type' => $req->type]); }
        if($req->email) { $user->update(['email'=>$req->email]); }
        if($req->phone) { $user->update(['phone'=>$req->phone]); }

        return response()->json(['updated' => $user], 201);
    }
}