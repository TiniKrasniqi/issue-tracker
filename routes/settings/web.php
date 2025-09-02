<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Settings\SettingsController;



Route::middleware(['verified'])->group(function () {


    //Route::resource('settings', SettingsController::class);
    Route::GET('app-settings', [SettingsController::class, "showAppSettings"])->name('settings.app-settings');
    Route::GET('mail-settings', [SettingsController::class, "showMailSettings"])->name('settings.mail-settings');
    Route::PUT('app-update', [SettingsController::class, "updateAppSettings"])->name('settings.app-update');
    Route::PUT('mail-update', [SettingsController::class, "updateMailSettings"])->name('settings.mail-update');
    Route::GET('cache-clear',[SettingsController::class,'clearCache'])->middleware('can:cache.clear')->name('cache.clear');

});