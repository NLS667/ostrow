<?php

/*
     * Services Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:view-service-management',
    ], function () {
        Route::group(['namespace' => 'Service'], function () {
        	/*
             * For DataTables
             */
            Route::post('service/get', ServiceTableController::class)->name('service.get');

            /*
             * For Calendar
             */
            Route::get('service/getlist', [\App\Http\Controllers\Backend\Service\ServiceController::class, 'getList'])->name('service.getlist');

            /*
             * Producer CRUD
             */
            Route::resource('service', ServiceController::class);

            /*
             * Specific Producer
             */
            Route::group(['prefix' => 'service/{service}'], function () {

            });
        });
    });
?>