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
            array_push($clo_array,$clo->id);
        }
        $question['clos'] = $clo_array;

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
        return response()->json(['question'=> $question],200);
    }

    public function getAllQuestions()
    {
        $questions = Question::all();
        $array = array();
        foreach($questions as $question){
            $answer = array();
            $subject = Subject::findOrFail($question->subject_id);
            $question['subject'] = $subject->subject_name;
            
            $clos = Cloquestion::all()->where('question_id',$question->id);
            $clo_array = array();
            foreach($clos as $clo){
                $clo = Clo::findOrFail($clo->clo_id);
                array_push($clo_array,$clo->clo_name);
            }
            $question['clos'] = $clo_array;

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
            array_push($array,$question);
        }
        return response()->json(['questions'=> $array],200);
    }

    public function getAuthorQuestion(Request $request)
    {
        $questions = Question::all()->where('author_id',$request->author_id);
        $array = array();
        foreach($questions as $question){
            $answer = array();
            $subject = Subject::findOrFail($question->subject_id);
            $question['subject'] = $subject->subject_name;
            
            $clos = Cloquestion::all()->where('question_id',$question->id);
            $clo_array = array();
            foreach($clos as $clo){
                $clo = Clo::findOrFail($clo->clo_id);
                array_push($clo_array,$clo->clo_name);
            }
            $question['clos'] = $clo_array;

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
            array_push($array,$question);
        }
        return response()->json(['questions'=> $array],200);

    }

    public function getAuthorSubQuestion(Request $request)
    {
        $questions = Question::where('author_id',$request->author_id)->where('subject_id',$request->subject_id)->get();
        $array = array();
        foreach($questions as $question){
            $answer = array();
            $subject = Subject::findOrFail($question->subject_id);
            $question['subject'] = $subject->subject_name;
            
            $clos = Cloquestion::all()->where('question_id',$question->id);
            $clo_array = array();
            foreach($clos as $clo){
                $clo = Clo::findOrFail($clo->clo_id);
                array_push($clo_array,$clo->clo_name);
            }
            $question['clos'] = $clo_array;

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
            array_push($array,$question);
        }
        return response()->json(['questions'=> $array],200);

    }

    public function getSubQuestions(Request $request)
    {
        $questions = Question::all()->where('subject_id',$request->subject_id);
        $array = array();
        foreach($questions as $question){
            $answer = array();
            $subject = Subject::findOrFail($question->subject_id);
            $question['subject'] = $subject->subject_name;
            
            $clos = Cloquestion::all()->where('question_id',$question->id);
            $clo_array = array();
            foreach($clos as $clo){
                $clo = Clo::findOrFail($clo->clo_id);
                array_push($clo_array,$clo->clo_name);
            }
            $question['clos'] = $clo_array;

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
            $answer = array();
            $subject = Subject::findOrFail($question->subject_id);
            $question['subject'] = $subject->subject_name;
            
            $clos = Cloquestion::all()->where('question_id',$question->id);
            $clo_array = array();
            foreach($clos as $clo){
                $clo = Clo::findOrFail($clo->clo_id);
                array_push($clo_array,$clo->clo_name);
            }
            $question['clos'] = $clo_array;


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
            array_push($array,$question);
        }
        return response()->json(['questions'=> $array],200);
    }


    public function editQuestion(Request $request)
    {
        // var_dump($request);
        $question = Question::findOrFail($request->question_id); 
        // var_dump($question);
        // $subject = Subject::findOrFail($question->subject_id);
        // $question['subject'] = $subject->subject_name;
        
        // $clos = Cloquestion::all()->where('question_id',$question->id);
        // $clo_array = array();
        // foreach($clos as $clo){
        //     $clo = Clo::findOrFail($clo->clo_id);
        //     array_push($clo_array,$clo->clo_name);
        // }
        // $question['clos'] = $clo_array;


        // if ($question->answer_type == 0) {
        //     $answer = Textanswer::get()->where('question_id',$question->id);
        // }else{
        //     $answer = Mcqanswer::all()->where('question_id',$question->id) ;
        // }
        // $question['answer'] = $answer;
        
        $new_question = $request->validate([
            'body'        => 'required|string|',
            'subject_id'  => 'required|exists:subjects,id',
            'level'       => 'required|' . Rule::in([0,1,2]),
            'answer_type' => 'required|' .Rule::in([0,1]),
           
        ]);  
        
        $question->update([
            'body' => $new_question['body'],
            'subject_id' => $new_question['subject_id'],
            'level' => $new_question['level'],
            'answer_type' => $new_question['answer_type'],
            'author_id'   => Auth::user()->id,
        ]);
        self::editQuestionAnswer($request);
        self::editQuestionClo($request);
        return response()->json(
            ['message'=>'question updated']
        ,200);
    }

    public function editQuestionClo($request)
    {
        $questionClos = Cloquestion::where('question_id',$request->question_id)->delete();
    
        foreach ($request->clos as $clo ) {
            
            $clo = Cloquestion::create([
                'clo_id'      => $clo,
                'question_id' => $request->question_id,
            ]);
            
        }
        return response()->json(
            ['message'=>'question clo updated']
        ,200);
    }

    public function editQuestionAnswer($request)
    {
        
        if ($request->answer_type == 0) {
            $answer = Textanswer::where('question_id',$request->question_id)->delete();
            $answer = $request->validate([
                'answer_body' => 'required|string'
                
            ]);

            $answer = Textanswer::create([
                'body'        => $answer['answer_body'],
                'question_id' => $request->question_id,
            ]);
        }else{
            $answer = Mcqanswer::where('question_id',$request->question_id)->delete();
            foreach($request->mcqs as $mcq){
                
                $mcq = Mcqanswer::create([
                    'question_id' => $request->question_id,
                    'body'        => $mcq['body'],
                    'status'      => $mcq['status'], 
                ]);
                
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
