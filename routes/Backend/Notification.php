<?php

//use App\Http\Controllers\Backend\NotificationController;

/*
 * Notificatons Management
 */
Route::resource('notification', NotificationController::class, ['except' => ['show', 'create', 'store']]);

Route::get('notification/getlist', 'App\Http\Controllers\Backend\NotificationController@ajaxNotifications')->name('admin.notification.getlist');

Route::get('notification/clearcurrentnotifications', 'App\Http\Controllers\Backend\NotificationController@clearCurrentNotifications')->name('admin.notification.clearcurrentnotifications');

Route::group(['prefix' => 'notification/{id}', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('mark/{is_read}', 'App\Http\Controllers\Backend\NotificationController@mark')->name('admin.notification.mark')->where(['is_read' => '[0,1]']);
});
