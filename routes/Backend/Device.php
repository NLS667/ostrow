<?php

/*
     * Device Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:view-device-management',
    ], function () {
        Route::group(['namespace' => 'Device'], function () {
        	/*
             * For DataTables
             */
            Route::post('device/get', DeviceTableController::class)->name('device.get');

            /*
             * Model CRUD
             */
            Route::resource('device', DeviceController::class);

            /*
             * Specific Device
             */
            Route::group(['prefix' => 'device/{device}'], function () {

            });
        });
    });
?>