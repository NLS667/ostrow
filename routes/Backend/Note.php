<?php

/*
     * Producers Management
     */
    Route::group(['namespace' => 'Producer'], function () {
            
            /*
             * Note CRUD
             */
            Route::resource('note', NoteController::class);

            /*
             * For notes 
             */
            Route::post('note/add-note', [\App\Http\Controllers\Backend\Note\NoteController::class, 'store'])->name('note.add');

            /*
             * Specific Note
             */
            Route::group(['prefix' => 'note/{note}'], function () {

            });
        });
?>