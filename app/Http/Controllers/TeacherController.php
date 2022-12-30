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
        return response()->json($teachers,200);
    }

    public function getTeacher($tcrId)
    {   
        $teacher = User::findOrFail($tcrId);
        $subs = Subjectsassign::all()->where('teacher_id',$teacher->id);
        $subjects_names =array();

        foreach ($subs as $sub => $subject_id) {
            $subjects = Subject::find($subject_id);
            foreach ($subjects as $subject => $subject_name) {
                
                array_push($subjects_names,$subject_name->subject_name);
            }
            
        }


        $teacher['subjects'] =$subjects_names;
        return response()->json([
            'teacher' => $teacher
        ],200);
    }
}
