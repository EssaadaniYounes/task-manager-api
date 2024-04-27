<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function (){
    Route::post("/register", [AuthController::class, "Register"])->name("register");
    Route::post("/login", [AuthController::class, "Login"])->name("login");
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/greeting', function () {
    return 'Hello World';
});
