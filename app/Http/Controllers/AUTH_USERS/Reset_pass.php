<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Models\password_resets;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Reset_pass extends Controller
{
    public function __construct() {   $this->middleware('auth:api', ['except' => ['sendresetpasswordemail','resetpassword']]); }
 
    public function sendresetpasswordemail(Request $request)
    {
        $request->validate([ 'email' => 'required|exists:Users|email:rfc,dns',])  ;       

        $user = User::where('email',$request->email)->first();

        if ($user)
         {
            $token = mt_rand(000000, 999999);
            DB::table('password_resets')->insert(
                [ 'email' => $request->email,   'token' => $token,     'created_at' => Carbon::now(),   ]);
            
            $email = $request->email;
            $name = $user->first_name;
            $subject = 'Resetting Password';
            Mail::send(
                'sendrestpassemail',
                ['name' => $user->first_name, 'token' => $token],
                function ($mail) use ($email, $name, $subject)
                 {
                    $mail->from('backend@ams.com');  $mail->to($email, $name);   $mail->subject($subject);
                 }
            );

            return response()->json(['success' => 'Check your email inbox for pin '], 200);
        } 
        else { return response()->json(['err' =>'user not sign-up !'], 200); }
    }

    public function confirm_pin(Request $request)
    {
        $user =password_resets::where('email', $request->email)->where('token', $request->token)->first(); 
        if ($user) 
        {
            return response()->json(['success' => true]);
        } else 
        {
            return response()->json(['success' => false, 'message' => 'invalid pin'], 422);
        }
    }

    protected function respondWithToken($token)          
    {
        return response()->json(['token'=>$token,'expires_in'=>auth()->factory()->getTTL()*60]);
    }
    
    public function resetpassword(Request $req)
    {
        $email = password_resets::where('token', $req->token)->where('email', $req->email)->first();
        
        if ($email)
         {
            $users = User::where('email', $req->email);
            $user=  $users->first();

            $users->update(['password' => Hash::make($req->password)]); 

            password_resets::where('email', $req->email)->delete();

            $credentials = $req->only(['email', 'password']);

            if ($token = auth()->attempt($credentials)) {   return $this->respondWithToken($token);    }
            
            else { return response()->json('login failed'); }
        
         } 
        else
         {  return response()->json(["err" => "Pin is not valid"], 422);  }
    }
}