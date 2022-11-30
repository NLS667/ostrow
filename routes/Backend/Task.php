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

            Route::get('task/filter', [\App\Http\Controllers\Backend\Task\TaskController::class, 'filter'])->name('task.filter');

            /*
             * Task CRUD
             */
            Route::resource('task', TaskController::class);

            /*
             * For Calendar
             */
            Route::post('task/updateDates', [\App\Http\Controllers\Backend\Task\TaskController::class, 'updateDates'])->name('task.updateDates');

            /*
             * Specific Task
             */
            Route::group(['prefix' => 'task/{task}'], function () {

                // isFinished
                Route::get('mark/{isFinished}', [\App\Http\Controllers\Backend\Task\TaskStatusController::class, 'mark'])->name('task.mark')->where(['isFinished' => '[0,1]']);
            });
            
        });
    });
