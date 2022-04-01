<?php

/*
     * Producers Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:view-producer-management',
    ], function () {
        Route::group(['namespace' => 'Producer'], function () {
        	/*
             * For DataTables
             */
            Route::post('producer/get', ProducerTableController::class)->name('producer.get');

            /*
             * Producer CRUD
             */
            Route::resource('producer', ProducerController::class);

            /*
             * Specific Producer
             */
            Route::group(['prefix' => 'producer/{producer}'], function () {

            });
        });
    });
?>