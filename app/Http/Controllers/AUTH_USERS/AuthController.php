<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;;

class AuthController extends Controller
{
    public function __construct() {  $this->middleware('auth:api', ['except' => [] ]); }
    public function me() {return response()->json(auth()->user());  }   //  Get the authenticated User.        
    public function refresh() {return $this->respondWithToken(auth()->refresh()); }
    public function logout() { auth()->logout(); return response()->json(['success' => 'logged out']);}
}
