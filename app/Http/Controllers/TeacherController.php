<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Subjectsassign;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function getTeachers()
    {
        $teachers = User::all()->where('role','teacher')->values();
        $array = array();
        foreach ($teachers as $teacher) {
            array_push($array,$teacher);
        }
        return response()->json(
            ['teachers'=>$array]
            ,200);
    }

    public function getTeacher(Request $request)
    {   
        $teacher = User::findOrFail($request->id);
        $subs = Subjectsassign::all()->where('teacher_id',$teacher->id);
        $subjects_names =array();

        foreach ($subs as $sub ) {
            $subjects = Subject::get()->where('id',$sub->subject_id);
            // dd($subjects);
            foreach ($subjects as $subject => $subject_name) {
                
                array_push($subjects_names,$subject_name);
            }
            
        }


        $teacher['subjects'] =$subjects_names;
        return response()->json([
            'teacher' => $teacher
        ],200);
    }

    public function editTeacher(Request $request)
    {
        $new_teacher = $request->validate([
            'id'        => 'exists:users,id',
            'full_name' => 'required|string',
            'email'     => 'required|string|email|exists:users,email',
           
        ]);  
        
        $teacher = User::findOrFail($request->id);
        $teacher->update($new_teacher);
        return response()->json(
            ['message'=>'teacher updated']
        ,200);
    }

    public function deleteTeacher(Request $request)
    {
        $teacher = User::findOrFail($request->id);
        $teacher->delete();
        return response()->json([
            'message' => 'teacher deleted'
        ],200);
        
    }
}


