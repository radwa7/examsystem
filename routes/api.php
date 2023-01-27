<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//public routes


Route::post('/login', [App\Http\Controllers\AuthController::class,'login']);
Route::post('/checkEmail', [App\Http\Controllers\AuthController::class,'checkEmail']);




//authentiaction protected routes
Route::middleware('auth:sanctum')->group(function(){
    Route::post('/resetPassword', [App\Http\Controllers\AuthController::class,'resetPass']);
    //admin only routes
    Route::middleware('isAdmin')->group(function(){
        
        //user
        Route::post('/registerUser', [App\Http\Controllers\AuthController::class,'registerUser']);
        Route::get('getUsers',[App\Http\Controllers\AdminController::class,'getUsers']);
        Route::post('activateUser',[App\Http\Controllers\AdminController::class,'toggleUserStatus']);
        Route::post('deactivateUser',[App\Http\Controllers\AdminController::class,'toggleUserStatus']);

        //admin
        Route::get('getAdmins',[App\Http\Controllers\AdminController::class,'getAdmins']);
        Route::post('getAdmin',[App\Http\Controllers\AdminController::class,'getAdmin']);
        Route::post('editAdmin',[App\Http\Controllers\AdminController::class,'editAdmin']);
        Route::post('deleteAdmin',[App\Http\Controllers\AdminController::class,'deleteAdmin']);
       
        
        //teacher
        Route::get('getTeachers',[App\Http\Controllers\TeacherController::class,'getTeachers']);
        Route::post('getTeacher',[App\Http\Controllers\TeacherController::class,'getTeacher']);
        Route::post('editTeacher',[App\Http\Controllers\AdminController::class,'editTeacher']);
        Route::post('deleteTeacher',[App\Http\Controllers\AdminController::class,'deleteTeacher']);
        
        //subject
        Route::post('createSubject',[App\Http\Controllers\SubjectController::class,'createSub']);
        Route::get('getSubjects',[App\Http\Controllers\SubjectController::class,'getSubjects']);
        Route::post('getSubject',[App\Http\Controllers\SubjectController::class,'getSubject']);
        Route::post('editSubject',[App\Http\Controllers\SubjectController::class,'editSubject']);
        Route::post('deleteSubject',[App\Http\Controllers\SubjectController::class,'deleteSubject']);
        Route::post('assignSub',[App\Http\Controllers\SubjectController::class,'assignSub']);
        Route::post('assignAll',[App\Http\Controllers\SubjectController::class,'assignAll']);


    });
    //profile
    Route::post('/logout', [App\Http\Controllers\AuthController::class,'logout']);
    Route::get('/profile', [App\Http\Controllers\AuthController::class,'profile']);
    Route::post('/editProfile', [App\Http\Controllers\AuthController::class,'editProfile']);

    //CLOs
    Route::get('getClos',[App\Http\Controllers\CLOController::class,'getClos']);
    Route::post('getClo',[App\Http\Controllers\CLOController::class,'getClo']);
    Route::post('getSubClo',[App\Http\Controllers\CLOController::class,'getSubClo']);
    Route::post('createClo',[App\Http\Controllers\CLOController::class,'createClo']);
    Route::post('editClo',[App\Http\Controllers\CLOController::class,'editClo']);
    Route::post('deleteClo',[App\Http\Controllers\CLOController::class,'deleteClo']);
    

    //Questions
    Route::post('createQuestion',[App\Http\Controllers\QuestionController::class,'createQuestion']);
    Route::get('getAllQuestions',[App\Http\Controllers\QuestionController::class,'getAllQuestions']);
    Route::post('getSubQuestions',[App\Http\Controllers\QuestionController::class,'getSubQuestions']);
    Route::post('getCloQuestions',[App\Http\Controllers\QuestionController::class,'getCloQuestions']);
    Route::post('getQuestion',[App\Http\Controllers\QuestionController::class,'getQuestion']);
    Route::post('getAuthorQuestion',[App\Http\Controllers\QuestionController::class,'getAuthorQuestion']);
    Route::post('getAuthorSubQuestion',[App\Http\Controllers\QuestionController::class,'getAuthorSubQuestion']);
    Route::post('editQuestion',[App\Http\Controllers\QuestionController::class,'editQuestion']);
    Route::post('editQuestionClo',[App\Http\Controllers\QuestionController::class,'editQuestionClo']);
    Route::post('editQuestionAnswer',[App\Http\Controllers\QuestionController::class,'editQuestionAnswer']);
    Route::post('deleteQuestion',[App\Http\Controllers\QuestionController::class,'deleteQuestion']);


    //Exam
    Route::post('/createExam', [App\Http\Controllers\ExamController::class,'createExam']);
    Route::post('/editExam', [App\Http\Controllers\ExamController::class,'editExam']);
    Route::post('/deleteExam', [App\Http\Controllers\ExamController::class,'deleteExam']);
    
    
    

    
    
});

