<?php

/*
 * For DataTables
 */
Route::post('task/get', TaskTableController::class)->name('task.get');

/*
 * Task CRUD
 */
Route::resource('task', TaskController::class);


Route::get('task/filter', 'TaskController@filter');