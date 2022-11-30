<?php

/*
     * Producers Management
     */
    Route::group(['namespace' => 'Producer'], function () {
            
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