<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function getTeachers()
    {
        $teachers = User::all()->where('role','teacher');
        return response()->json($teachers,200);
    }
}
