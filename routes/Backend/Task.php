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
            Route::get('task/resource', [\App\Http\Controllers\Backend\Task\TaskController::class, 'resource'])->name('task.resource');

            /*
             * Task CRUD
             */
            Route::resource('task', TaskController::class);

            /*
             * For Calendar
             */
            Route::post('task/updateDates', [\App\Http\Controllers\Backend\Task\TaskController::class, 'updateDates'])->name('task.updateDates');

            /*
             * For Raport
             */
            Route::group(['prefix' => 'task/{task}'], function () {                
                
            });


            Route::post('task/store_raport', [\App\Http\Controllers\Backend\Task\TaskController::class, 'store_raport'])->name('task.storeRaport');
            /*
             * Specific Task
             */
            Route::group(['prefix' => 'task/{task}'], function () {

                //Raport
                Route::get('create_raport', [\App\Http\Controllers\Backend\Task\TaskController::class, 'create_raport'])->name('task.createRaport');

                Route::get('get_raport', [\App\Http\Controllers\Backend\Task\TaskController::class, 'get_raport'])->name('task.getRaport');

                // isFinished
                Route::get('mark/{isFinished}', [\App\Http\Controllers\Backend\Task\TaskStatusController::class, 'mark'])->name('task.mark')->where(['isFinished' => '[0,1]']);
            });
            
        });
    });
