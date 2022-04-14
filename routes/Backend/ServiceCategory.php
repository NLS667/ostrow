<?php

/*
     * Service Category Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:view-servicecat-management',
    ], function () {
        Route::group(['namespace' => 'ServiceCategory'], function () {
        	/*
             * For DataTables
             */
            Route::post('serviceCategory/get', ServiceCategoryTableController::class)->name('serviceCategory.get');

            /*
             * Service Category CRUD
             */
            Route::resource('serviceCategory', ServiceCategoryController::class);

            /*
             * Specific Service Category
             */
            Route::group(['prefix' => 'serviceCategory/{serviceCategory}'], function () {

            });
        });
    });
?>