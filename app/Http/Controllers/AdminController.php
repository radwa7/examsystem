<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAdmins()
    {
        $admins = User::where('role','admin')->orWhere('role','super admin')->get();
        $array = array();
        foreach($admins as $admin){
            array_push($array,$admin);
        }
        return response(['Admins'=>$array],200);
    }

    public function getUsers()
    {
        $users = User::all();
        $array = array();
        foreach($users as $user){
            array_push($array,$user);
        }
        return response(['Users'=>$array],200);
    }

    public function getAdmin(Request $request)
    {
        $admin = User::findOrFail($request->id);
        return response()->json([
            'Admin' => $admin
        ],200);
    }

    public function toggleUserStatus(Request $request)
    {
        foreach($request->users as $user){
            $temp = User::findOrFail($user);
            if ($temp->status == 'active') {
                $temp->update(['status' => 'deactivated']);
            }else {
                $temp->update(['status' => 'active']); 
            }
            response()->json(['message' => 'status changed'],200);
        }
    }

    public function editAdmin(Request $request)
    {
        $new_admin = $request->validate([
            'id'        => 'exists:users,id',
            'full_name' => 'required|string',
            'email'     => 'required|string|email|exists:users,email',
           
        ]);  
        
        $admin = User::findOrFail($request->id);
        $admin->update($new_admin);
        return response()->json(
            ['message'=>'admin updated']
        ,200);
    }

    public function deleteAdmin(Request $request)
    {
        $admin = User::findOrFail($request->id);
        $admin->delete();
        return response()->json([
            'message' => 'admin deleted'
        ],200);
        
    }
}
