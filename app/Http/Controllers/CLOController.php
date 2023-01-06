<?php

namespace App\Http\Controllers;

use App\Models\Clo;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CLOController extends Controller
{
    public function createClo(Request $request)
    {
        $data = $request->validate([
            'clo_name'    => 'required|string|',
            'subject_id'  => 'required|exists:subjects,id',
            
        ]);

        $clo = Clo::create([
            'clo_name' => $data['clo_name'],
            'subject_id' => $data['subject_id'],
            'author_id' => Auth::user()->id,
        ]);

       
        return response()->json(
            ['clo'=>$clo]
        ,200);
    }

    public function getClo(Request $request)
    {
        $clo = Clo::findOrFail($request->id);
        $subject = Subject::findOrFail($clo->subject_id);
        $clo['subject_name'] = $subject->subject_name;

        return response()->json(
            ['clo'=>$clo]
        ,200);
    }

    public function getClos()
    {
        $array = array();
        $clos = Clo::all();
        foreach($clos as $clo){
            $subject = Subject::findOrFail($clo->subject_id);
            $clo['subject_name'] = $subject->subject_name;
            array_push($array,$clo);
        }
        return response()->json(
            ['clos'=>$array]    
        ,200);
    }

    public function getSubClo(Request $request)
    {
        $array = array();
        $clos = Clo::all()->where('subject_id',$request->subject_id);
        foreach($clos as $clo){
            $subject = Subject::findOrFail($clo->subject_id);
            $clo['subject_name'] = $subject->subject_name;
            array_push($array,$clo);
        }
        return response()->json([
            'clos' => $array
        ],200);
    }

    public function editClo(Request $request)
    {
        $new_clo = $request->validate([
            'clo_name'    => 'required|string|',
            'subject_id'  => 'required|exists:subjects,id',
           
        ]);  
        
        $clo = Clo::findOrFail($request->id);
        $clo->update($new_clo);
        return response()->json(
            ['message'=>'clo updated']
        ,200);
    }

    public function deleteClo(Request $request)
    {
        $clo = Clo::findOrFail($request->id);
        $clo->delete();
        return response()->json([
            'message' => 'clo deleted'
        ],200);
    }
}
