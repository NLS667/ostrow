<?php

use App\Http\Controllers\Frontend\FrontendController;
//use App\Http\Controllers\Frontend\User\AccountController;
//use App\Http\Controllers\Frontend\User\ProfileController;
//use App\Http\Controllers\Frontend\User\DashboardController;

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('/', [FrontendController::class, 'index'])->name('index');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {

        /*
         * User Dashboard Specific
         */

        //Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
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