<?php

use App\Http\Controllers\Backend\Client\ClientStatusController;

/*
     * Client Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:view-client-management',
    ], function () {
        Route::group(['namespace' => 'Client'], function () {
        	/*
             * For DataTables
             */
            Route::post('client/get', ClientTableController::class)->name('client.get');

            /*
             * For Geocoding 
             */
            Route::post('client/getcoordinates', [\App\Http\Controllers\Backend\Client\ClientController::class, 'getCoordinates'])->name('client.get.coordinates');

            /*
             * Client Status'
             */
            Route::get('client/deactivated', [ClientStatusController::class, 'getDeactivated'])->name('client.deactivated');
            Route::get('client/deleted', [ClientStatusController::class, 'getDeleted'])->name('client.deleted');

            Route::get('client/getserviceform', [\App\Http\Controllers\Backend\Client\ClientController::class, 'getServiceForm'])->name('client.getserviceform');
            /*
             * Client CRUD
             */
            Route::resource('client', ClientController::class);

            /*
             * Specific Client
             */
            Route::group(['prefix' => 'client/{client}'], function () {

                // Status
                Route::get('mark/{status}', [ClientStatusController::class, 'mark'])->name('client.mark')->where(['status' => '[0,1]']);

                Route::group(['prefix' => 'repository'], function () {
                     \UniSharp\LaravelFilemanager\Lfm::routes();
                 });
            });

            /*
             * Deleted Client
             */
            Route::group(['prefix' => 'client/{deletedClient}'], function () {
                Route::get('delete', [ClientStatusController::class, 'delete'])->name('client.delete-permanently')->withTrashed();
                Route::get('restore', [ClientStatusController::class, 'restore'])->name('client.restore')->withTrashed();
            });
        });
    });
?>