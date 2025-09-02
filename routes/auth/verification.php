<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;


Route::GET('/email/verify/{id}/{hash}', [AuthController::class,'handleEmailConfirmation'])->middleware('signed')->name('verification.verify');

//Route::GET('/verification-confirmed', [AuthController::class,'showVerifyConfirmation'])->name('verification.confirmed');

Route::get('/email/verify', [AuthController::class,'verifyEmail'])->name('verification.notice');


Route::post('/email/verification/resend', [AuthController::class, 'resendVerificationEmail'])->name('verification.resend');

