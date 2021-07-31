<?php
namespace App\Http\Controllers\AUTH_USERS;

use App\Http\Controllers\Auto\Auto_student;
use App\Http\Controllers\Controller;
use App\Http\Requests\update_student_;
use App\Models\Student;
use App\Models\User;

class Update_student extends Controller
{
    public function __construct() {  $this->middleware('auth:api', ['except' =>  []]); }
   
    public function update_student(update_student_ $req)  
    {
        $student = Student::where('Student_id', $req->Student_id);
        //////////////// make it comment to quickly uploaaaaaaaaaaaaaaaaaaaaaad ////////////////
      //  $x = new Auto_student();         $x->auto_student();    /********** AUTOMATIC *************/

        if ($req->roadmap) {$student->update(array('roadmap' => $req->roadmap));}

        if($req->dep_id && $req->sec_id) 
          {
            $student->update(array('dep_id'=>$req->dep_id,'sec_id'=>$req->sec_id));                    
          }

        if($req->adv_id) 
         {
            $advisor = User::where('id', $req->adv_id)->where('type',2)->first();
            $counter = Student::where('adv_id', $req->adv_id)->get()->count();

            if (!$advisor) { return response()->json(['err' => "advisor not found"], 401); } 

            if($counter>=10) { return response()->json(['err'=>"can't follow advisor he has ".$counter." Students"],401); } 
                 
            else { $student->update(array('adv_id'=>$advisor->id));  }
            
          }

        return response()->json(['Success' => $student->first()], 201);
    }
}
