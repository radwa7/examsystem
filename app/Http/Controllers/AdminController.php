<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAdmins()
    {
        $admins = User::all()->where('role','admin');
        return response(['Admins'=>$admins],200);
    }

    public function getUsers()
    {
        $users = User::all();
        return response(['Users'=>$users],200);
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
}
