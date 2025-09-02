<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route::middleware(['verified'])->group(function () {
    

    Route::GET('/users', [UserController::class, 'showUsers'])->middleware('can:user.view-all')->name('users.show');
    Route::GET('/users/disabled', [UserController::class, 'showDisabledUsers'])->middleware('can:user.view-all')->name('users.disabled');
    Route::GET('/users/admin', [UserController::class, 'showAdminUsers'])->middleware('can:user.view-all')->name('users.admin');
    Route::GET('/users/{user}/edit', [UserController::class, 'showUserEditForm'])->middleware('can:user.edit')->name('users.edit');

    Route::PUT('users/{user}', [UserController::class, 'update'])->middleware('can:user.edit')->name('users.update');
    Route::DELETE('users/{user}', [UserController::class, 'destroy'])->middleware('can:user.delete');

    Route::GET('/profile', [UserController::class, 'showUserProfile'])->middleware('can:profile.update')->name('user.profile');
    Route::PUT('/profile/{user}', [UserController::class, 'editProfile'])->middleware('can:profile.update')->name('profile.update');


    Route::GET('/account', [UserController::class, 'account'])->middleware('can:profile.update')->name('user.account');


});
