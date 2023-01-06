<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//public routes


Route::post('/login', [App\Http\Controllers\AuthController::class,'login']);
Route::post('/checkEmail', [App\Http\Controllers\AuthController::class,'checkEmail']);
Route::post('/resetPassword', [App\Http\Controllers\AuthController::class,'resetPass']);



//authentiaction protected routes
Route::middleware('auth:sanctum')->group(function(){
    //admin only routes
    Route::middleware('isAdmin')->group(function(){
        
        //user
        Route::post('/registerUser', [App\Http\Controllers\AuthController::class,'registerUser']);
        Route::get('getUsers',[App\Http\Controllers\AdminController::class,'getUsers']);
        Route::post('activateUser',[App\Http\Controllers\AdminController::class,'toggleUserStatus']);
        Route::post('deactivateUser',[App\Http\Controllers\AdminController::class,'toggleUserStatus']);

        //admin
        Route::get('getAdmins',[App\Http\Controllers\AdminController::class,'getAdmins']);
        Route::get('getAdmin',[App\Http\Controllers\AdminController::class,'getAdmin']);
        Route::post('editAdmin',[App\Http\Controllers\AdminController::class,'editAdmin']);
        Route::post('deleteAdmin',[App\Http\Controllers\AdminController::class,'deleteAdmin']);
       
        
        //teacher
        Route::get('getTeachers',[App\Http\Controllers\TeacherController::class,'getTeachers']);
        Route::get('getTeacher',[App\Http\Controllers\TeacherController::class,'getTeacher']);
        Route::post('editTeacher',[App\Http\Controllers\AdminController::class,'editTeacher']);
        Route::post('deleteTeacher',[App\Http\Controllers\AdminController::class,'deleteTeacher']);
        
        //subject
        Route::post('createSub',[App\Http\Controllers\SubjectController::class,'createSub']);
        Route::post('assignSub',[App\Http\Controllers\SubjectController::class,'assignSub']);
        Route::get('getSubjects',[App\Http\Controllers\SubjectController::class,'getSubjects']);
        Route::post('assignAll',[App\Http\Controllers\SubjectController::class,'assignAll']);


    });
    
    Route::post('/logout', [App\Http\Controllers\AuthController::class,'logout']);
    Route::get('/profile', [App\Http\Controllers\AuthController::class,'profile']);
    Route::post('/editProfile', [App\Http\Controllers\AuthController::class,'editProfile']);
    
    
    

    
    
});

