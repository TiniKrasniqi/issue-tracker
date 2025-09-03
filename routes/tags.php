<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

Route::get('tags', [TagController::class, 'index'])->name('tags.index');
Route::post('tags', [TagController::class, 'store'])->name('tags.store');

