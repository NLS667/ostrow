<?php

use App\Http\Controllers\Backend\AdminController;

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('/', [AdminController::class, 'index'])->name('index');
Route::post('get-permission', [AdminController::class, 'getPermissionByRole'])->name('get.permission');

/*
 * Edit Profile
*/
Route::get('profile/edit', [AdminController::class, 'editProfile'])->name('profile.edit');
Route::patch('profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
