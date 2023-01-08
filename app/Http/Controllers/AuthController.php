<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Subjectsassign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    
    public function test()
    {
     
        return response()->json(
            [
                'message' => 'Hello',
            ]
            ,200);
    }

    public function registerUser(Request $request)
    {
        
        $data = $request->validate([
            'full_name' => 'required|string',
            'email'     => 'required|string|email|unique:users,email',
            'password'  => 'required|string|confirmed',
            'role'      => 'required|'
        ]);

        $user = User::create([
            'full_name' => $data['full_name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'role'      => $data['role'],
            'status'    => 'deactivated',
            'author_id' => Auth::user()->id,
        ]);

        
        $response = [
            'user'  => $user,            
        ];

        return response()->json($response,201);

    }


    public function login(Request $request)
    {
        $data = $request->validate([
            'email'     => 'required|string|email',
            'password'  => 'required|string',
        ]);

        //gets user from DB
        $user = User::where('email',$data['email'])->first();
        
        //check user email
        if (!$user) {
            $response = ['message' => 'user not found'];
            $code = 404;
        }else {
            //checks password
            if (Hash::check($data['password'],$user->password)){
                //checks if account is activated befor loging in
                if ($user->status == 'active') {
                    $token = $user->createToken('myappToken')->plainTextToken;
                    $response = [
                        'user'  => $user,
                        'token' => $token
                    ]; 
                    $code = 201;
                }else{
                    $response = ['message' => 'please activate account before logining in'];
                    $code = 403;
                }
                
            }else {
                $response = ['message' => 'password incorrect'];
                $code = 401;
            }
        }

        return response()->json($response,$code);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged Out'
        ],200);
    }

    public function profile()
    {
        $user = Auth::user();
        
        if ($user->role == 'teacher') {
            
            $subs = Subjectsassign::all()->where('teacher_id',$user->id);
            
            $subjects_names =array();

            foreach ($subs as $sub ) {
                $subjects = Subject::get()->where('id',$sub->subject_id);
                foreach ($subjects as $subject => $subject_name) {
                    
                    array_push($subjects_names,$subject_name->subject_name);
                } 
            }
            $user['subjects'] =$subjects_names;
        }
        return response()->json($user);
    }

    public function editProfile(Request $request)
    {
       
        $user = User::findOrFail($request->id);
        $user->update($request->all());
        return response()->json(['user'=>$user],200);

    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);
        return response()->json(['email'=>$request->email],200);
    }

    public function resetPass(Request $request)
    {
        $user = User::where('email',$request->email);
        var_dump(Auth::user()->role);
        if (Auth::user()->role == 'admin'||Auth::user()->id == $user->id) {
            $user->update(['password' => Hash::make($request->password)]);
            if (Auth::user()->role == 'admin') {
                $user->update(['status' =>'deactivated' ]); 
            }
            return response()->json(['response'=>'password changed'],200);
        }
        else {
            return response()->json(['message' => 'not authorized'],200);
        }
    }

}
