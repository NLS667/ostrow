<?php

use App\Http\Controllers\Backend\Finance\ClientStatusController;

/*
     * Finance Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:view-finance-management',
    ], function () {
        Route::group(['namespace' => 'Finance'], function () {
        	/*
             * For DataTables
             */
            //Route::post('client/get', ClientTableController::class)->name('client.get');

            /*
             * For Geocoding 
             */
            //Route::post('client/getcoordinates', [\App\Http\Controllers\Backend\Client\ClientController::class, 'getCoordinates'])->name('client.get.coordinates');

            /*
             * Client Status'
             */
            //Route::get('client/deactivated', [ClientStatusController::class, 'getDeactivated'])->name('client.deactivated');
            //Route::get('client/deleted', [ClientStatusController::class, 'getDeleted'])->name('client.deleted');

            //Route::get('client/getserviceform', [\App\Http\Controllers\Backend\Client\ClientController::class, 'getServiceForm'])->name('client.getserviceform');
            /*
             * Client CRUD
             */
            Route::resource('finance', FinanceController::class);

            /*
             * Specific Client
             */
            //Route::group(['prefix' => 'client/{client}'], function () {

                // Status
            //    Route::get('mark/{status}', [ClientStatusController::class, 'mark'])->name('client.mark')->where(['status' => '[0,1]']);
            //});

            /*
             * Deleted Client
             */
            //Route::group(['prefix' => 'client/{deletedClient}'], function () {
            //    Route::get('delete', [ClientStatusController::class, 'delete'])->name('client.delete-permanently')->withTrashed();
            //    Route::get('restore', [ClientStatusController::class, 'restore'])->name('client.restore')->withTrashed();
            //});
        });
    });
?>