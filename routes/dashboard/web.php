<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\File;

Route::middleware(['verified'])->group(function () {

    Route::GET('home', [DashboardController::class, 'showDashboard'])->name('dashboard');
   
});
