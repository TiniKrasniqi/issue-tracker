<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordResetController;


use Illuminate\Http\Request;



Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'emailResetLink'])->middleware('guest')->name('password.email');
 
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->middleware('guest')->name('password.update');
// Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');



// Route::get('/reset-password/{token}', function (Request $request , string $token) {
//     return view('auth.reset-password', ['token' => $token, 'email' => $request->input('email')]);
// })->middleware('guest')->name('password.reset');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->middleware('guest')->name('password.reset');