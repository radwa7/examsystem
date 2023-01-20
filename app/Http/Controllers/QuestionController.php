<?php

namespace App\Http\Controllers;

use App\Models\Clo;
use App\Models\Cloquestion;
use App\Models\Mcqanswer;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Textanswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    public function createQuestion(Request $request)
    {
                
        $question = $request->validate([
            'body'        => 'required|string|unique:questions,body',
            'subject_id'  => 'required|exists:subjects,id',
            'level'       => 'required|' . Rule::in([0,1,2]),
            'answer_type' => 'required|' .Rule::in([0,1]),

        ]);

        $subject = Subject::find($request->subject_id);
        // foreach($request->clos as $clo){
        //     $clo->validate([
        //         $clo    => 'required|exists:clos,id',
        //     ]);
        // }

        $question = Question::create([
            'body'        => $question['body'],
            'subject_id'  => $question['subject_id'],
            'level'       => $question['level'],
            'author_id'   => Auth::user()->id,
            'answer_type' => $question['answer_type'],
        ]);

        $question['subject'] = $subject->subject_name;

        foreach ($request->clos as $clo ) {
            $clo_array = array();
            $clo = Cloquestion::create([
                'clo_id'      => $clo,
                'question_id' => $question->id,
            ]);
            array_push($clo_array,$clo);
        }
        $question['clos'] = $clo_array ;

        if ($question->answer_type == 0) {
            $answer = $request->validate([
                'answer_body' => 'required|string'
                
            ]);

            $answer = Textanswer::create([
                'body'        => $answer['answer_body'],
                'question_id' => $question->id,
            ]);
            $question['answer'] = $answer ;
        }else {
            foreach($request->mcqs as $mcq){
                $mcq_array = array();
                $mcq = Mcqanswer::create([
                    'question_id' => $question->id,
                    'body'        => $mcq['body'],
                    'status'      => $mcq['status'], 
                ]);
                array_push($mcq_array,$mcq);
            }
            $question['mcqs'] = $mcq_array ;
        }
        
        

        return response()->json(
            ['question' => $question]
        ,200);        
       
    }

    public function getQuestion(Request $request)
    {
        $question = Question::findOrFail($request->question_id); 
        $subject = Subject::findOrFail($question->subject_id);
        $question['subject'] = $subject->subject_name;
        
        $clos = Cloquestion::all()->where('question_id',$question->id);
        $clo_array = array();
        foreach($clos as $clo){
            $clo = Clo::findOrFail($clo->clo_id);
            array_push($clo_array,$clo->clo_name);
        }
        $question['cols'] = $clo_array;


        if ($question->answer_type == 0) {
            $answer = Textanswer::get()->where('question_id',$question->id);
        }else{
            $answer = Mcqanswer::all()->where('question_id',$question->id) ;
        }
        $question['answer'] = $answer;
        return response()->json(['question'=> $question],200);
    }

    public function getAllQuestions()
    {
        $questions = Question::all();
        $array = array();
        foreach($questions as $question){
            $subject = Subject::findOrFail($question->subject_id);
            $question['subject'] = $subject->subject_name;
            
            $clos = Cloquestion::all()->where('question_id',$question->id);
            $clo_array = array();
            foreach($clos as $clo){
                $clo = Clo::findOrFail($clo->clo_id);
                array_push($clo_array,$clo->clo_name);
            }
            $question['cols'] = $clo_array;

            if ($question->answer_type == 0) {
                $answer = Textanswer::get()->where('question_id',$question->id);
            }else{
                $answer = Mcqanswer::all()->where('question_id',$question->id) ;
            }
            $question['answer'] = $answer;
            array_push($array,$question);
        }
        return response()->json(['questions'=> $array],200);
    }

    public function getAuthorQuestion(Request $request)
    {
        $questions = Question::all()->where('author_id',$request->author_id);
        $array = array();
        foreach($questions as $question){
            $subject = Subject::findOrFail($question->subject_id);
            $question['subject'] = $subject->subject_name;
            
            $clos = Cloquestion::all()->where('question_id',$question->id);
            $clo_array = array();
            foreach($clos as $clo){
                $clo = Clo::findOrFail($clo->clo_id);
                array_push($clo_array,$clo->clo_name);
            }
            $question['cols'] = $clo_array;

            if ($question->answer_type == 0) {
                $answer = Textanswer::get()->where('question_id',$question->id);
            }else{
                $answer = Mcqanswer::all()->where('question_id',$question->id) ;
            }
            $question['answer'] = $answer;
            array_push($array,$question);
        }
        return response()->json(['questions'=> $array],200);

    }

    public function getSubQuestions(Request $request)
    {
        $questions = Question::all()->where('subject_id',$request->subject_id);
        $array = array();
        foreach($questions as $question){
            $subject = Subject::findOrFail($question->subject_id);
            $question['subject'] = $subject->subject_name;
            
            $clos = Cloquestion::all()->where('question_id',$question->id);
            $clo_array = array();
            foreach($clos as $clo){
                $clo = Clo::findOrFail($clo->clo_id);
                array_push($clo_array,$clo->clo_name);
            }
            $question['cols'] = $clo_array;

            if ($question->answer_type == 0) {
                $answer = Textanswer::get()->where('question_id',$question->id);
            }else{
                $answer = Mcqanswer::all()->where('question_id',$question->id) ;
            }
            $question['answer'] = $answer;
            array_push($array,$question);
        }
        return response()->json(['questions'=> $array],200);
    }

    public function getCloQuestions(Request $request)
    {
        $questions = Question::join('cloquestions','questions.id','=','cloquestions.question_id')
                                ->where('questions.subject_id',$request->subject_id)
                                ->where('cloquestions.clo_id',$request->clo_id)
                                ->get('questions.*','cloquestions.*');
                    
        $array = array();
        foreach($questions as $question){
            $subject = Subject::findOrFail($question->subject_id);
            $question['subject'] = $subject->subject_name;
            
            $clos = Cloquestion::all()->where('question_id',$question->id);
            $clo_array = array();
            foreach($clos as $clo){
                $clo = Clo::findOrFail($clo->clo_id);
                array_push($clo_array,$clo->clo_name);
            }
            $question['cols'] = $clo_array;


            if ($question->answer_type == 0) {
                $answer = Textanswer::get()->where('question_id',$question->id);
            }else{
                $answer = Mcqanswer::all()->where('question_id',$question->id) ;
            }
            $question['answer'] = $answer;
            array_push($array,$question);
        }
        return response()->json(['questions'=> $array],200);
    }


    public function editQuestion(Request $request)
    {
        $question = Question::findOrFail($request->question_id); 
        $subject = Subject::findOrFail($question->subject_id);
        $question['subject'] = $subject->subject_name;
        
        $clos = Cloquestion::all()->where('question_id',$question->id);
        $clo_array = array();
        foreach($clos as $clo){
            $clo = Clo::findOrFail($clo->clo_id);
            array_push($clo_array,$clo->clo_name);
        }
        $question['cols'] = $clo_array;


        if ($question->answer_type == 0) {
            $answer = Textanswer::get()->where('question_id',$question->id);
        }else{
            $answer = Mcqanswer::all()->where('question_id',$question->id) ;
        }
        $question['answer'] = $answer;
        
        $new_question = $request->validate([
            'body'        => 'required|string|unique:questions,body',
            'subject_id'  => 'required|exists:subjects,id',
            'level'       => 'required|' . Rule::in([0,1,2]),
            'answer_type' => 'required|' .Rule::in([0,1]),
           
        ]);  

        $question->update($new_question);
        return response()->json(
            ['message'=>'question updated']
        ,200);
    }

    public function editQuestionClo(Request $request)
    {
        $questionClo = Cloquestion::find($request->question_id);
        $questionClo->clo_id->update($request->clo_id);
        return response()->json(
            ['message'=>'question clo updated']
        ,200);
    }

    public function editQuestionAnswer(Request $request)
    {
        $ques = Question::findOrFail($request->question_id);
        if ($ques->answer_type == 0) {
            $answer = Textanswer::find($ques->id);
            $answer->update($request->all());
        }else{
            $answer = Mcqanswer::find($ques->id);
            foreach($answer as $mcq){
                $mcq->update($request->all());
            }
        }
        return response()->json([
            'message' => "answer updated"
        ],200);
    }

    public function deleteQuestion(Request $request)
    {
        $question = Question::findOrFail($request->question_id);
        $question->delete();
        return response()->json([
            'message' => 'question deleted'
        ],200);
    }


}
