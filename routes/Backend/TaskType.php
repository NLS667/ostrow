<?php

/*
     * Task Type Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:view-tasktype-management',
    ], function () {
        Route::group(['namespace' => 'TaskType'], function () {
        	/*
             * For DataTables
             */
            Route::post('taskType/get', TaskTypeTableController::class)->name('taskType.get');

            /*
             * Task Type CRUD
             */
            Route::resource('taskType', TaskTypeController::class);

            /*
             * Specific Task Type
             */
            Route::group(['prefix' => 'taskType/{taskType}'], function () {

            });
        });
    });
?>