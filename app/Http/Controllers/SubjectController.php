<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Subjectsassign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
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

        return response()->json([
            'subject' => $subject
        ],201);
    }

    public function getSubjects()
    {
        $subjects = Subject::all();
        $array = array();
        foreach($subjects as $subject){
            array_push($array,$subject);
        }
        return response()->json(['subjects'=> $array],200);
    }

    public function getSubject(Request $request)
    {
        $subject = Subject::findOrFail($request->id);
        return response()->json([
            'subject' => $subject
        ],200);
    }

    public function editSubject(Request $request)
    {
        $new_subject = $request->validate([
            'id'            => 'exists:users,id',
            'subject_name'  => 'required|string|exists:subjects,subject_name',
           
        ]);  
        
        $subject = Subject::findOrFail($request->id);
        $subject->update($new_subject);
        return response()->json(
            ['message'=>'subject updated']
        ,200);
    }

    public function deleteSubject(Request $request)
    {
        $subject = Subject::findOrFail($request->id);
        $subject->delete();
        return response()->json([
            'message' => 'subject deleted'
        ],200);
        
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

    public function assignAll(Request $request)
    {
        $array = array();
        foreach($request->teachersIds as $teacherId){
            foreach ($request->subjectsIds as $subjectId ) {
                
                $assigned = Subjectsassign::create([
                    'teacher_id' => $teacherId,
                    'subject_id' => $subjectId,
                    'author_id'  => Auth::user()->id ,
                ]);
                
                array_push($array,$assigned);
            }
            $teacher = User::find($teacherId);
            $teacher->update(['status' => 'active']);
        }
        $res = array();
        foreach ($array as $key) {
            $sub = Subject::find($key->subject_id);
            $response =[
                'teacher_id' => $key->teacher_id,
                'subject'   => $sub->subject_name,
            ] ;
            array_push($res,$response);
        }
        return response()->json($res);

    }

    


}
