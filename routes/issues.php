<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\IssueTagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IssueAssigneeController;

Route::resource('issues', IssueController::class);

Route::post('issues/{issue}/tags/sync', [IssueTagController::class, 'sync'])->name('issues.tags.sync');



Route::get('issues/{issue}/comments', [CommentController::class, 'index'])->name('issues.comments.index');
Route::post('issues/{issue}/comments', [CommentController::class, 'store'])->name('issues.comments.store'); 

Route::post('issues/{issue}/assignees/sync', [IssueAssigneeController::class, 'sync'])->name('issues.assignees.sync');