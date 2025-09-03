<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;



Route::GET('/', function(){
    return redirect("/projects");
});


//Registration Route
Route::GET('/register', [AuthController::class,'showRegistrationForm']);
Route::POST('/register',[AuthController::class,'register'])->name('auth.store');

//Login Route
Route::GET('/login', [AuthController::class,'showLoginForm'])->name('login');
Route::POST('/login', [AuthController::class,'login'])->name('login.authenticate');

//Change Password Route
Route::POST('/changePassword',[AuthController::class,'updatePassword'])->name('auth.update-pass');

//Logout Route
Route::GET('/logout', [AuthController::class, 'logout'])->name('logout');

Route::GET('/user-disabled', [AuthController::class, 'accDisabled'])->name('account.disabled');