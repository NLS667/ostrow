<?php

/*
     * Models Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:view-model-management',
    ], function () {
        Route::group(['namespace' => 'Model'], function () {
        	/*
             * For DataTables
             */
            Route::post('model/get', ModelTableController::class)->name('model.get');

            /*
             * Model CRUD
             */
            Route::resource('model', ModelController::class);

            /*
             * Specific Model
             */
            Route::group(['prefix' => 'model/{model}'], function () {

            });
        });
    });
?>