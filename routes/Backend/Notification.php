<?php

//use App\Http\Controllers\Backend\NotificationController;

/*
 * Notificatons Management
 */
Route::resource('notification', NotificationController::class, ['except' => ['show', 'create', 'store']]);

Route::get('notification/getlist', [NotificationController::class, 'ajaxNotifications'])->name('admin.notification.getlist');

Route::get('notification/clearcurrentnotifications', [NotificationController::class, 'clearCurrentNotifications'])->name('admin.notification.clearcurrentnotifications');

Route::group(['prefix' => 'notification/{id}', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('mark/{is_read}', [NotificationController::class, 'mark'])->name('admin.notification.mark')->where(['is_read' => '[0,1]']);
});
