<?php

use App\Http\Controllers\Backend\Access\User\UserTableController;
use App\Http\Controllers\Backend\Access\User\UserStatusController;
use App\Http\Controllers\Backend\Access\User\UserController;
use App\Http\Controllers\Backend\Access\User\UserConfirmationController;
use App\Http\Controllers\Backend\Access\User\UserPasswordController;
use App\Http\Controllers\Backend\Access\User\UserAccessController;
use App\Http\Controllers\Backend\Access\User\UserSessionController;
use App\Http\Controllers\Backend\Access\Role\RoleController;
use App\Http\Controllers\Backend\Access\Role\RoleTableController;
use App\Http\Controllers\Backend\Access\Permission\PermissionController;
use App\Http\Controllers\Backend\Access\Permission\PermissionTableController;

/**
 * All route names are prefixed with 'admin.access'.
 */
Route::group([
    'prefix'    => 'access',
    'as'        => 'access.',
    'namespace' => 'Access',
], function () {

    /*
     * User Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:view-access-management',
    ], function () {
        Route::group(['namespace' => 'User'], function () {
            /*
             * For DataTables
             */
            Route::post('user/get', UserTableController::class)->name('user.get');

            /*
             * User Status'
             */
            Route::get('user/deactivated', [UserStatusController::class, 'getDeactivated'])->name('user.deactivated');
            Route::get('user/deleted', [UserStatusController::class, 'getDeleted'])->name('user.deleted');

            /*
             * User CRUD
             */
            Route::resource('user', UserController::class);

            /*
             * Specific User
             */
            Route::group(['prefix' => 'user/{user}'], function () {
                // Account
                Route::get('account/confirm/resend', [UserConfirmationController::class, 'sendConfirmationEmail'])->name('user.account.confirm.resend');

                // Status
                Route::get('mark/{status}', [UserStatusController::class, 'mark'])->name('user.mark')->where(['status' => '[0,1]']);

                // Password
                Route::get('password/change', [UserPasswordController::class, 'edit'])->name('user.change-password');
                Route::patch('password/change', [UserPasswordController::class, 'update'])->name('user.change-password');

                // Access
                Route::get('login-as', [UserAccessController::class, 'loginAs'])->name('user.login-as');

                // Session
                Route::get('clear-session', [UserSessionController::class, 'clearSession'])->name('user.clear-session');
            });

            /*
             * Deleted User
             */
            Route::group(['prefix' => 'user/{deletedUser}'], function () {
                Route::get('delete', [UserStatusController::class, 'delete'])->name('user.delete-permanently');
                Route::get('restore', [UserStatusController::class, 'restore'])->name('user.restore');
            });
        });

        /*
        * Role Management
        */
        Route::group(['namespace' => 'Role'], function () {
            Route::resource('role', RoleController::class, ['except' => ['show']]);

            //For DataTables
            Route::post('role/get', RoleTableController::class)->name('role.get');
        });

        /*
        * Permission Management
        */
        Route::group(['namespace' => 'Permission'], function () {
            Route::resource('permission', PermissionController::class, ['except' => ['show']]);

            //For DataTables
            Route::post('permission/get', PermissionTableController::class)->name('permission.get');
        });
    });
});
