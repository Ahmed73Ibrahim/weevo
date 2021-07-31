<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class Del_student extends Controller
{
    public function __construct()  {  $this->middleware('auth:api', ['except' =>[]]); }

    public function del_student(Request  $req)
    {
        $req->validate(['Student_id' => 'required|integer|exists:Students']);
        Student::where('Student_id', $req->Student_id)->delete();
        return response()->json(['Success' => "Student deleted"], 201);
    }
}