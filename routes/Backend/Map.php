<?php

use App\Http\Controllers\Backend\Map\MapController;

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('map', [MapController::class, 'index'])->name('map.index');
