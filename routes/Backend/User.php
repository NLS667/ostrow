<?php

use App\Http\Controllers\Backend\User\AccountController;
use App\Http\Controllers\Backend\User\ProfileController;

/*
 * These backend controllers require the user to be logged in
 * All route names are prefixed with 'admin.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        //Route::get('admin', 'DashboardController@index')->name('dashboard');

        /*
         * User Account Specific
         */
        //Route::get('account', [AccountController::class, 'index'])->name('account');

        /*
         * User Profile Specific
         */
        //Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');

        /*
         * User Profile Picture
         */
        //Route::patch('profile-picture/update', [ProfileController::class, 'updateProfilePicture'])->name('profile-picture.update');
    });
});
