<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\IssueTagController;

Route::resource('issues', IssueController::class);

Route::post('issues/{issue}/tags/sync', [IssueTagController::class, 'sync'])->name('issues.tags.sync');
