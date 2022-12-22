<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        ]);

        $user = User::create([
            'full_name' => $data['full_name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'role'      => 'teacher',
            'status'    => 'deactivated'
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

}
