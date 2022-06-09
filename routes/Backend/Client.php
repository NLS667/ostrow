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

                Route::group(compact([ CreateDefaultFolder::class, MultiUser::class ], 'unisharp.lfm.', '\\UniSharp\\LaravelFilemanager\\Controllers\\'), function () {
                    // display integration error messages
                    Route::get('/errors', [
                        'uses' => 'LfmController@getErrors',
                        'as' => 'getErrors',
                    ]);

                    // upload
                    Route::any('/upload', [
                        'uses' => 'UploadController@upload',
                        'as' => 'upload',
                    ]);

                    // list images & files
                    Route::get('/jsonitems', [
                        'uses' => 'ItemsController@getItems',
                        'as' => 'getItems',
                    ]);

                    Route::get('/move', [
                        'uses' => 'ItemsController@move',
                        'as' => 'move',
                    ]);

                    Route::get('/domove', [
                        'uses' => 'ItemsController@domove',
                        'as' => 'domove'
                    ]);

                    // folders
                    Route::get('/newfolder', [
                        'uses' => 'FolderController@getAddfolder',
                        'as' => 'getAddfolder',
                    ]);

                    // list folders
                    Route::get('/folders', [
                        'uses' => 'FolderController@getFolders',
                        'as' => 'getFolders',
                    ]);

                    // crop
                    Route::get('/crop', [
                        'uses' => 'CropController@getCrop',
                        'as' => 'getCrop',
                    ]);
                    Route::get('/cropimage', [
                        'uses' => 'CropController@getCropimage',
                        'as' => 'getCropimage',
                    ]);
                    Route::get('/cropnewimage', [
                        'uses' => 'CropController@getNewCropimage',
                        'as' => 'getCropnewimage',
                    ]);

                    // rename
                    Route::get('/rename', [
                        'uses' => 'RenameController@getRename',
                        'as' => 'getRename',
                    ]);

                    // scale/resize
                    Route::get('/resize', [
                        'uses' => 'ResizeController@getResize',
                        'as' => 'getResize',
                    ]);
                    Route::get('/doresize', [
                        'uses' => 'ResizeController@performResize',
                        'as' => 'performResize',
                    ]);

                    // download
                    Route::get('/download', [
                        'uses' => 'DownloadController@getDownload',
                        'as' => 'getDownload',
                    ]);

                    // delete
                    Route::get('/delete', [
                        'uses' => 'DeleteController@getDelete',
                        'as' => 'getDelete',
                    ]);
                }

                // Status
                Route::get('mark/{status}', [ClientStatusController::class, 'mark'])->name('client.mark')->where(['status' => '[0,1]']);
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