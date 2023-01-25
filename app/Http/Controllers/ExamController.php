<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    public function createExam(Request $request)
    {
        
        $data = $request->validate([
            'title'         =>  'required',
            'subject_id'    =>  'required|exists:subjects,id',
            'genration_type'=>  'required|in:1,2',
            'author_id'     =>  'required',
            'semester'      =>  'required',
            'code'          =>  'required',
            'date'          =>  'required',
            'year'          =>  'required',
            'status'        =>  'required|',
            'total_score'   =>  'required|',
            'duration'      =>  'required',
            'clos'          =>  'required',
        ]);
        
        $exam = Exam::create([
            'title'         =>  $data['title'],
            'subject_id'    =>  $data['subject_id'],
            'genration_type'=>  $data['genration_type'],
            'author_id'     =>  Auth::user()->id,
            'semester'      =>  $data['semester'],
            'code'          =>  $data['code'],
            'date'          =>  $data['date'],
            'year'          =>  $data['year'],
            'status'        =>  0,
            'total_score'   =>  $data['total_score'],
            'duration'      =>  $data['duration'],
        ]);
        
        $questions = array();
        if($request->genration_type == 1){
            foreach ($request->clos as $clo) {
                
                    
                    $key = ExamQuestion::create([
                        'exam_id'     => $exam['id'],
                        'question_id' => $clo['question_id'],
                        'score'       => null,
                    ]);
                    array_push($questions,$key);
                
            }
            $exam['questions']=$questions;
        }else{

        }
       
        return $exam;
    }

    public function deleteExam(Request $request)
    {
        $exam = Exam::findOrFail($request->exam_id);
        $exam->delete();
        return response()->json([
            'message' => 'exam deleted'
        ],200);
    }
}
