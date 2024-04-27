<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function (){
    Route::post("/register", [AuthController::class, "Register"])->name("register");
    Route::post("/login", [AuthController::class, "Login"])->name("login");
});

Route::middleware("auth:sanctum")->group(function (){
    Route::resource("tasks", TaskController::class);
});
