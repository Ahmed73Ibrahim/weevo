<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Change_pass extends Controller
{
    public function __construct()  {  $this->middleware('auth:api', ['except' =>[]]); }
       
    public function change_pass(Request $req)
    {
        $req->validate(['password' => 'required|min:8',
                        'new_pass' => 'required|min:8|required_with:conifrm_new_pass|same:conifrm_new_pass']);
 
        $user = Auth()->user();

        if ($user) 
        {
            $x = Hash::check($req->password, $user->password);

            if (!$x) { return response()->json(["err" => " password is wrong "], 400);}
           
            else if ($req->password == $req->new_pass)
             {
                return response()->json(["err"=>"old pass = new pass"], 400);
             } 
             else
             {
                User::where('id', $user->id)->update(array('password' => hash::make($req->new_pass)));
                return response()->json(["success" => "Pass changed"], 200);
             }
        }}}