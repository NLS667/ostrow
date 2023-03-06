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
if(config('app.debug')){
    URL::forceRootUrl('https://ostrow.uroczysko.org/');
}

/* ----------------------------------------------------------------------- */
/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/Frontend/');
});

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
