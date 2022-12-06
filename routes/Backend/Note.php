<?php

/*
     * Producers Management
     */
    Route::group(['namespace' => 'Producer'], function () {


            /*
             * For notes 
             */
            Route::post('note/add-note', [\App\Http\Controllers\Backend\Note\NoteController::class, 'store'])->name('note.add');
            //Route::post('note/edit', [\App\Http\Controllers\Backend\Note\NoteController::class, 'update'])->name('note.update');
            //Route::delete('note/delete/{note}', [\App\Http\Controllers\Backend\Note\NoteController::class, 'destroy'])->name('note.destroy');

            /*
             * Note CRUD
             */
            Route::resource('note', NoteController::class);
            

            /*
             * Specific Note
             */
            Route::group(['prefix' => 'note/{note}'], function () {

            });
        });
?>