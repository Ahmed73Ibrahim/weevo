<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class Deep_search extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' =>[] ]);}
  
    public function deep_search(Request $req)  
    {
        $arr= [] ; $arr2= [] ;

        $q =auth()->user();
        if($q->type==1)
        {
            return response()->json(['err'=>"not allowed for student"]);
        }

        $req->validate(['all' => 'numeric|min:1|not_in:0']);
        $user=0;

        if ($req->first_name) 
        {
            if($req->last_name)
            {
                $req->validate(['last_name' => 'string|exists:Users','first_name' => 'string|exists:Users']);

                $user = User::where('first_name', $req->first_name)->where('last_name', $req->last_name)->get();
            }
            
            $req->validate(['first_name' => 'string|exists:Users']);
            $user = User::where('first_name', $req->first_name)->get();

        } 
        else if ( $req->first_name  && $req->last_name ) 
        {
            $user = User::where('first_name', $req->first_name)->where('last_name', $req->last_name)->get();

        } 
        
        else if ($req->id)
         {
            $req->validate(['id' => 'integer|exists:Users']);
            $user = User::where('id', $req->id)->get();
        }
         else if ($req->email) 
         {
            $req->validate(['email' => 'email:rfc,dns|exists:Users']);
            $user = User::where('email', $req->email)->get();

        }
         else if ($req->phone) 
         {
            $req->validate(['email' => 'email:rfc,dns|exists:Users']);
            $user = User::where('phone', $req->phone)->get();
        }

        if ($req->dep_id) 
        {

            if (! $req->sec_id) 
            {
                return response()->json(['err'=>"please enter sec_id"]);
            }
            
            $req->validate(['dep_id' => 'integer|exists:Departments', 'sec_id' => 'integer|exists:Sections']);
            $user = Student::where('dep_id', $req->dep_id)->where('sec_id', $req->sec_id)->get();
        } 

         else if ($req->all) 
        {
            $user = User::all();
        }

        else if ($req->lvl)
         {
            $req->validate(['lvl' => 'integer|between:1,4']);
            $user = Student::where('lvl', $req->lvl)->get();

         }

         else if ($req->adv_id) 
         {
            $req->validate(['adv_id' => 'integer|exists:Users,id']);
            $advisor=User::where('id',$req->adv_id)->first();
            if($advisor->type!=2){ return response()->json(['err'=>"this not adv id"]);}
            $user = Student::where('adv_id', $req->adv_id)->get();
         } 


         if($user==null)
         {
            return response()->json(['err'=>"please choose option"]);
         }

        for ($i=0; $i <$user->count() ; $i++) 
       { 
            if($user[$i]->type==1 || $user[$i]->lvl )
            {
                $arr[]=$user[$i] ; 
            }
            else
            {
                $arr2[]=$user[$i] ; 
            }

       }

        if(!$user) { return response()->json(['err'=>"enter choice"]);}
        //return response()->json(['success' =>  $user], 201);
        return response()->json(['student' => $arr , 'others'=>$arr2], 201); 
    }}