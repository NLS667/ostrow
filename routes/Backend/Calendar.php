<?php

use App\Http\Controllers\Backend\Calendar\CalendarController;


/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');
