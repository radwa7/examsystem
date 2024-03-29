<?php

namespace App\Http\Controllers;

use App\Models\Clo;
use App\Models\Mcqanswer;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Subjectsassign;
use App\Models\Textanswer;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rule;
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

    public function editSubject(Request $request)
    {
        $new_subject = $request->validate([
            'id'            => 'exists:subjects,id',
            'subject_name'  => 'required|string|',
           
        ]);  
        
        $subject = Subject::findOrFail($request->id);
        $subject->update($new_subject);
        return response()->json(
            ['message'=>'subject updated']
        ,200);
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

    public function getSubjectDetails(Request $request)
    {
        $subject = Subject::findOrFail($request->subject_id);
        $clos_array = array();
        $clos = Clo::all()->where('subject_id',$subject->id);
        foreach($clos as $clo){
            $questions = Question::join('cloquestions','questions.id','=','cloquestions.question_id')
                                ->where('questions.subject_id',$subject->id)
                                ->where('cloquestions.clo_id',$clo->id)
                                ->get('questions.*','cloquestions.*');
            $questions_array = array();
            foreach ($questions as $question) {
                $answer = array();
                if ($question->answer_type == 0) {
                    $answers = Textanswer::get()->where('question_id',$question->id);
                    foreach($answers as $item){
                        $answer = $item->body;
                    }
                }else{
                    $answers = Mcqanswer::all()->where('question_id',$question->id) ;
                    foreach($answers as $mcq){
                        $temp['body'] = $mcq->body; 
                        $temp['status'] = $mcq->status;
                        array_push($answer,$temp); 
                    }
                }
                $question['answer'] = $answer;
                array_push($questions_array,$question);
            }
            $clo['questions'] = $questions_array;
            array_push($clos_array,$clo);
        }
        $subject['clos']= $clos_array;
        return response()->json([
            'subject' => $subject
        ],200); 
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
        $teachersArray = $request->teachersIds;
        // var_dump($teachersArray);
        $array = array();
        foreach($teachersArray as $teacherId){
            
            foreach ($request->subjectsIds as $subjectId ) {
                $temp = Subjectsassign::get()->where('teacher_id',$teacherId)->where('subject_id',$subjectId);
                
                if(count($temp)==0){
                    $test = true;
                }else{
                    return response()->json(['message'=>' some teacher already assigned']);
                    
                }               
            }
            if ($test = true) {
                foreach ($request->subjectsIds as $subjectId ) {
                    $assigned = Subjectsassign::create([
                        'teacher_id' => $teacherId,
                        'subject_id' => $subjectId,
                        'author_id'  => Auth::user()->id ,
                    ]);
                    
                    array_push($array,$assigned);
                }
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

        return response()->json($res,200);

    }

    


}
