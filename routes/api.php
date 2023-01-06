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
        Route::post('createSubject',[App\Http\Controllers\SubjectController::class,'createSub']);
        Route::get('getSubjects',[App\Http\Controllers\SubjectController::class,'getSubjects']);
        Route::get('getSubject',[App\Http\Controllers\SubjectController::class,'getSubject']);
        Route::post('editSubject',[App\Http\Controllers\SubjectController::class,'editSubject']);
        Route::post('deleteSubject',[App\Http\Controllers\SubjectController::class,'deleteSubject']);
        Route::post('assignSub',[App\Http\Controllers\SubjectController::class,'assignSub']);
        Route::post('assignAll',[App\Http\Controllers\SubjectController::class,'assignAll']);


    });
    //CLOs
    Route::get('getClos',[App\Http\Controllers\CLOController::class,'getClos']);
    Route::get('getClo',[App\Http\Controllers\CLOController::class,'getClo']);
    Route::get('getSubClo',[App\Http\Controllers\CLOController::class,'getSubClo']);
    Route::post('createClo',[App\Http\Controllers\CLOController::class,'createClo']);
    Route::post('editClo',[App\Http\Controllers\CLOController::class,'editClo']);
    Route::post('deleteClo',[App\Http\Controllers\CLOController::class,'deleteClo']);
    

    
    Route::post('/logout', [App\Http\Controllers\AuthController::class,'logout']);
    Route::get('/profile', [App\Http\Controllers\AuthController::class,'profile']);
    Route::post('/editProfile', [App\Http\Controllers\AuthController::class,'editProfile']);
    
    
    

    
    
});

