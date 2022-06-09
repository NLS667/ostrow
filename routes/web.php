<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Backend\User\AccountController;
use App\Http\Controllers\Backend\User\ProfileController;
//use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('index');

/*
 * These frontend controllers require the user to be logged in
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


Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {

    /*
     * These routes require the user to be logged in
     */
    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');

        //For when admin is logged in as user from backend
        Route::get('logout-as', [LoginController::class, 'logoutAs'])->name('logout-as');

        // Change Password Routes
        Route::patch('password/change', [ChangePasswordController::class, 'changePassword'])->name('password.change');
    });

    /*
     * These routes require no user to be logged in
     */
    Route::group(['middleware' => 'guest'], function () {
        // Authentication Routes
        //Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login');

        // Socialite Routes
        //Route::get('login/{provider}', 'SocialLoginController@login')->name('social.login');

        // Registration Routes
        //if (config('access.users.registration')) {
        //    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        //    Route::post('register', 'RegisterController@register')->name('register');
        //}

        // Password Reset Routes
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.email');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');
    });
});

//Route::get('admin', [AdminController::class, 'index'])->name('index');

Route::group(['namespace' => 'Backend','prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    includeRouteFiles(__DIR__.'/Backend/');
});
