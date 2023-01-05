<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//public routes


Route::post('/login', [App\Http\Controllers\AuthController::class,'login']);
Route::post('/checkEmail', [App\Http\Controllers\AuthController::class,'checkEmail']);
Route::post('/resetPassword', [App\Http\Controllers\AuthController::class,'resetPass']);



//authentiaction protected routes
Route::middleware('auth:sanctum')->group(function(){
    
    Route::middleware('isAdmin')->group(function(){
        Route::post('/registerUser', [App\Http\Controllers\AuthController::class,'registerUser']);
        Route::post('createSub',[App\Http\Controllers\SubjectController::class,'createSub']);
        Route::post('assignSub',[App\Http\Controllers\SubjectController::class,'assignSub']);
        Route::get('getTeachers',[App\Http\Controllers\TeacherController::class,'getTeachers']);
        Route::get('getSubjects',[App\Http\Controllers\SubjectController::class,'getSubjects']);
        Route::get('getTeacher/{tcrId}',[App\Http\Controllers\TeacherController::class,'getTeacher']);
        Route::post('assignAll',[App\Http\Controllers\SubjectController::class,'assignAll']);
        Route::get('getAdmins',[App\Http\Controllers\AdminController::class,'getAdmins']);
        Route::get('getUsers',[App\Http\Controllers\AdminController::class,'getUsers']);
        Route::post('activateUser',[App\Http\Controllers\AdminController::class,'toggleUserStatus']);
        Route::post('deactivateUser',[App\Http\Controllers\AdminController::class,'toggleUserStatus']);


    });
    Route::get('/test', [App\Http\Controllers\AuthController::class,'test']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class,'logout']);
    Route::get('/profile', [App\Http\Controllers\AuthController::class,'profile']);
    Route::post('/editProfile', [App\Http\Controllers\AuthController::class,'editProfile']);
    
    
    

    
    
});

