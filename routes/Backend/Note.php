<?php

/*
     * Producers Management
     */
    Route::group(['namespace' => 'Producer'], function () {


            /*
             * For notes 
             */
            Route::post('note/add-note', [\App\Http\Controllers\Backend\Note\NoteController::class, 'store'])->name('note.add');
            Route::post('note/edit', [\App\Http\Controllers\Backend\Note\NoteController::class, 'update'])->name('note.update');
            Route::post('note/delete/{note}', [\App\Http\Controllers\Backend\Note\NoteController::class, 'destroy'])->name('note.destroy');
            

            /*
             * Specific Note
             */
            Route::group(['prefix' => 'note/{note}'], function () {

            });
        });
?>