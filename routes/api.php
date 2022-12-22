<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//public routes

Route::post('/register', [App\Http\Controllers\AuthController::class,'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class,'login']);



//authentiaction protected routes
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/test', [App\Http\Controllers\AuthController::class,'test']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class,'logout']);
    
    
    
});

