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
            'subject_name'  => 'required|string',
            
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
            'teacher_id' => 'required',
            'subject_id' => 'required'              
        ]);

        $assigned = Subjectsassign::create([
            'teacher_id' => $assigned['teacher_id'],
            'subject_id' => $assigned['subject_id'],
            'author_id'  => Auth::user()->id ,
        ]);

        $teacher = User::find($request->teacher_id);
        $teacher->update(['status', 'active']);

        return response()->json('teacher assgined subject',200);
    }


}
