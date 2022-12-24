<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Subjectsassign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;

class SubjectController extends Controller
{
    
    public function createSub(Request $request)
    {
        
        
        $subject = $request->validate([
            'subject_name'  => 'required|string|unique:subjects,subject_name',
            
        ]);
        
        
        $subject = Subject::create([
            'subject_name' => $subject['subject_name'],
            'author_id'    => Auth::user()->id,

        ]);

        return response()->json($subject,201);
    }

    public function assignSub(Request $request)
    {
        $assigned = $request->validate([
            'teacher_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id'              
        ]);

        $teacher = User::findOrFail($assigned['teacher_id']);
        if ($teacher->role =='teacher') {
            $assigned = Subjectsassign::create([
                'teacher_id' => $assigned['teacher_id'],
                'subject_id' => $assigned['subject_id'],
                'author_id'  => Auth::user()->id ,
            ]);
    
            $teacher = User::find($request->teacher_id);
            $teacher->update(['status' => 'active']);
    
            return response()->json('teacher assgined subject',200);  
        }else {
            return response()->json("cannot assign subject to admin",406);
        }

        
    }

    public function getSubjects()
    {
        $subjects = Subject::all();
        return response()->json($subjects,200);
    }


}
