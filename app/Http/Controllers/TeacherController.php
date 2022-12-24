<?php

namespace App\Http\Controllers;

use App\Models\Subjectsassign;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function getTeachers()
    {
        $teachers = User::all()->where('role','teacher');
        return response()->json($teachers,200);
    }

    public function getTeacher($tcrId)
    {   
        $teacher = User::findOrFail($tcrId);
        $subs = Subjectsassign::all()->where('teacher_id',$teacher->id);
        
        return response()->json([
            'teacher' => $teacher,
            'subjects_assigned' => $subs,
        ],200);
    }
}
