<?php

/*
     * Service Management
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
             * Service CRUD
             */
            Route::resource('service', ServiceController::class);

            /*
             * Specific Service
             */
            Route::group(['prefix' => 'service/{service}'], function () {

            });
        });
    });
?>