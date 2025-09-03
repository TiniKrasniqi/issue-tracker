<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;

Route::resource('issues', IssueController::class);

