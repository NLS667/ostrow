<?php
/**
 * Menu Management.
 */
Route::group(['namespace' => 'Menu'], function () {
    Route::resource('menus', MenuController::class, ['except' => []]);
    //For DataTables
    Route::post('menus/get', MenuTableController::class)->name('menus.get');
    // for Model Forms
    Route::get('menus/get-form/{name?}', [MenuFormController::class, 'create'])->name('menus.getform');
});
