<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Models\User; 
use Illuminate\Http\Request;

class Del_user extends Controller
{
    public function __construct()  {  $this->middleware('auth:api', ['except' =>[]]); }

    public function deL_user(Request  $req) 
    {
        $req->validate(['id' => 'required|integer|exists:Users']);
        User::find($req->id)->delete();
        return response()->json(['success' => 'User  Deleted  '], 201);
    } 
}