<?php

namespace App\Http\Controllers;

use App\Models\Cloquestion;
use App\Models\McqAnswer;
use App\Models\Question;
use App\Models\TextAnswer;
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
        foreach($request->clos as $clo){
            $clo->validate([
                $clo    => 'required|exists:clos,id',
            ]);
        }

        $question = Question::create([
            'body'        => $question['body'],
            'subject_id'  => $question['subject_id'],
            'level'       => $question['level'],
            'author_id'   => Auth::user()->id,
            'answer_type' => $question['answer_type'],
        ]);

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

            $answer = TextAnswer::create([
                'body'        => $answer['body'],
                'question_id' => $question->id,
            ]);
            $question['answer'] = $answer ;
        }else {
            foreach($request->mcqs as $mcq){
                $mcq_array = array();
                $mcq = McqAnswer::create([
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
}
