<?php
/*
     * Client Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:view-task-management',
    ], function () {
        Route::group(['namespace' => 'Task'], function () {
            /*
             * For DataTables
             */
            Route::post('task/get', TaskTableController::class)->name('task.get');

            /*
             * Task CRUD
             */
            Route::resource('task', TaskController::class);


            Route::get('task/filter', [TaskController::class, 'filter'])->name('task.filter');
        });
    });
