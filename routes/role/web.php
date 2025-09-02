<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Role\RoleController;

Route::middleware(['verified'])->group(function () {
    

    Route::GET('/roles', [RoleController::class, 'showRoles'])->middleware('can:role.view-all')->name('roles.show');
    Route::POST('/roles', [RoleController::class, 'store'])->middleware('can:role.add')->name('role.add');
    //Route::PUT('users/{user}', [UserController::class, 'update'])->name('users.update');



    Route::GET('/roles/{roleid}/edit', [RoleController::class, 'showRoleEditForm'])->middleware('can:role.edit')->name('roles.edit');
    Route::PUT('/roles/{roleid}', [RoleController::class, 'update'])->middleware('can:role.edit')->name('roles.update');
});
