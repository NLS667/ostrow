<?php

//use App\Http\Controllers\Backend\Callendar\CallendarController;


/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('callendar', [CallendarController::class, 'index'])->name('callendar.index');
