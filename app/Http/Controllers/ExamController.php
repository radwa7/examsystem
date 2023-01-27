<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\Mcqanswer;
use App\Models\Question;
use App\Models\Textanswer;
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
            'semester'      =>  'required',
            'code'          =>  'required',
            'date'          =>  'required',
            'year'          =>  'required',
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
            'duration'      =>  $data['duration'],
        ]);
        
        $questions_array = array();
        if($request->genration_type == 1){
            foreach ($request->clos as $clo) {
                $key = ExamQuestion::create([
                        'exam_id'     => $exam['id'],
                        'question_id' => $clo['question_id'],
                        'score'       => null,
                    ]);
                    array_push($questions_array,$key);          
            }
            $exam['questions']=$questions_array;
        }else{
            foreach ($request->clos as $clo) {
                $questions = Question::join('cloquestions','questions.id','=','cloquestions.question_id')
                                ->where('questions.subject_id',$data['subject_id'])
                                ->where('cloquestions.clo_id',$clo['clo_id'])
                                ->get('questions.*','cloquestions.*')->random(floor($request->no_questions*$clo['precentage']));           
                foreach ($questions as $question ) {
                    $key = ExamQuestion::create([
                        'exam_id'     => $exam['id'],
                        'question_id' => $question['id'],
                        'score'       => null,
                    ]);
                    array_push($questions_array,$key);  
                }
            }
            
            $exam['questions']=$questions_array;
        }
       
        return response()->json($exam);
    }

    public function editExam(Request $request)
    {
        $new_exam = $request->validate([
            'id'            =>  'required|exists:exams,id',
            'title'         =>  'required',
            'subject_id'    =>  'required|exists:subjects,id',
            'genration_type'=>  'required|in:1,2',
            'semester'      =>  'required',
            'code'          =>  'required',
            'date'          =>  'required',
            'year'          =>  'required',
            'duration'      =>  'required',
            'clos'          =>  'required',
        ]);

        $exam = Exam::findOrFail($request->id);
        $exam->update($new_exam);
        $exam_questions = ExamQuestion::where('exam_id',$request->id)->get();
        foreach ($exam_questions as $exam_question) {
            $exam_question->delete();
        }
        $questions_array = array();
        if($request->genration_type == 1){
            foreach ($request->clos as $clo) {
                $key = ExamQuestion::create([
                        'exam_id'     => $exam['id'],
                        'question_id' => $clo['question_id'],
                        'score'       => null,
                    ]);
                    array_push($questions_array,$key);          
            }
            $exam['questions']=$questions_array;
        }else{
            foreach ($request->clos as $clo) {
                $questions = Question::join('cloquestions','questions.id','=','cloquestions.question_id')
                                ->where('questions.subject_id',$request->subject_id)
                                ->where('cloquestions.clo_id',$clo['clo_id'])
                                ->get('questions.*','cloquestions.*')->random(floor($request->no_questions*$clo['precentage']));           
                foreach ($questions as $question ) {
                    $key = ExamQuestion::create([
                        'exam_id'     => $exam['id'],
                        'question_id' => $question['id'],
                        'score'       => null,
                    ]);
                    array_push($questions_array,$key);  
                }
            }
            
            $exam['questions']=$questions_array;
        }
       
        return response()->json($exam);
    }

    public function deleteExam(Request $request)
    {
        $exam = Exam::findOrFail($request->exam_id);
        $exam->delete();
        return response()->json([
            'message' => 'exam deleted'
        ],200);
    }

    public function getExam(Request $request)
    {
        $exam = Exam::findOrFail($request->exam_id);
        $exam_questions = ExamQuestion::where('exam_id',$request->exam_id)->get();
        $questions = array();
        foreach ($exam_questions as $question) {
            $question_body = Question::findOrFail($question->question_id);
            array_push($questions,$question_body);
            $answer = array();
            if ($question_body->answer_type == 0) {
                $answers = Textanswer::get()->where('question_id',$question_body->id);
                foreach($answers as $item){
                        $answer = $item->body;
                    }
            }else{
                $answers = Mcqanswer::all()->where('question_id',$question_body->id) ;
                foreach($answers as $mcq){
                    $temp['body'] = $mcq->body; 
                    $temp['status'] = $mcq->status;
                    array_push($answer,$temp); 
                }
            }
            $question_body['answer'] = $answer;
        }
        $exam['questions'] = $questions;
        return response()->json($exam);
    }

    public function getExamByAuthor(Request $request)
    {
        $exams = Exam::where('author_id',$request->author_id)->get();
        $allExams = array();
        foreach($exams as $exam){
            $exam_questions = ExamQuestion::where('exam_id',$exam->id)->get();
            $questions = array();
            foreach ($exam_questions as $question) {
                $question_body = Question::findOrFail($question->question_id);
                array_push($questions,$question_body);
                $answer = array();
                if ($question_body->answer_type == 0) {
                    $answers = Textanswer::get()->where('question_id',$question_body->id);
                    foreach($answers as $item){
                            $answer = $item->body;
                        }
                }else{
                    $answers = Mcqanswer::all()->where('question_id',$question_body->id) ;
                    foreach($answers as $mcq){
                        $temp['body'] = $mcq->body; 
                        $temp['status'] = $mcq->status;
                        array_push($answer,$temp); 
                    }
                }
                $question_body['answer'] = $answer;
            }
            $exam['questions'] = $questions;
            array_push($allExams,$exam);
        }
        return response()->json($allExams);
    }

    public function getExamByAuthorSub(Request $request)
    {
        $exams = Exam::where('author_id',$request->author_id)->where('subject_id',$request->subject_id)->get();
        $allExams = array();
        foreach($exams as $exam){
            $exam_questions = ExamQuestion::where('exam_id',$exam->id)->get();
            $questions = array();
            foreach ($exam_questions as $question) {
                $question_body = Question::findOrFail($question->question_id);
                array_push($questions,$question_body);
                $answer = array();
                if ($question_body->answer_type == 0) {
                    $answers = Textanswer::get()->where('question_id',$question_body->id);
                    foreach($answers as $item){
                            $answer = $item->body;
                        }
                }else{
                    $answers = Mcqanswer::all()->where('question_id',$question_body->id) ;
                    foreach($answers as $mcq){
                        $temp['body'] = $mcq->body; 
                        $temp['status'] = $mcq->status;
                        array_push($answer,$temp); 
                    }
                }
                $question_body['answer'] = $answer;
            }
            $exam['questions'] = $questions;
            array_push($allExams,$exam);
        }
        return response()->json($allExams);
    }

    public function getExamBySub(Request $request)
    {
        $exams = Exam::where('subject_id',$request->subject_id)->get();
        $allExams = array();
        foreach($exams as $exam){
            $exam_questions = ExamQuestion::where('exam_id',$exam->id)->get();
            $questions = array();
            foreach ($exam_questions as $question) {
                $question_body = Question::findOrFail($question->question_id);
                array_push($questions,$question_body);
                $answer = array();
                if ($question_body->answer_type == 0) {
                    $answers = Textanswer::get()->where('question_id',$question_body->id);
                    foreach($answers as $item){
                            $answer = $item->body;
                        }
                }else{
                    $answers = Mcqanswer::all()->where('question_id',$question_body->id) ;
                    foreach($answers as $mcq){
                        $temp['body'] = $mcq->body; 
                        $temp['status'] = $mcq->status;
                        array_push($answer,$temp); 
                    }
                }
                $question_body['answer'] = $answer;
            }
            $exam['questions'] = $questions;
            array_push($allExams,$exam);
        }
        return response()->json($allExams);

    }

   
    
}