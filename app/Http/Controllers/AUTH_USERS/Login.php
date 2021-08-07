<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $req)
    {
        $test_database = User::first();

        if (!$test_database) {
            $root = User::create(['id' => 19980218, 'name' => 'Ibrahim', 'pass' => 12345678, 'type' => 1, 'phone' => "01207053244", 'created_at' => now()]);
            return response()->json(['Root User' => $root]);
        }

        $req->validate([
            'phone' => 'required|numeric|regex:/(01)\d{9}/|digits:11|exists:users',
            'pass' => 'required|min:8'
        ]);

        $user = User::where('phone', $req->phone)->first();

        if (Hash::check($req->pass, $user->pass)){

            Auth::login($user)   ;

            $token = auth('api')->login($user);

            return response()->json(
                [
                    "token" => $token,
                    "name" => $user->name,
                    "phone" => $user->phone,
                    'type' =>  $user->type,
                    "id" => $user->id 
                ]); }
         else {
            return response()->json(['err' => "Wrong Credintials , Try a valid Phone or password"], 401);  }  
    }
}
