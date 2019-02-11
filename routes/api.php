<?php

Route::middleware(['auth', 'core'])
  ->group(function () {
    // add your local routes
  });

// === AREAS ============
Route::namespace ('Wheels\Areas')
  ->prefix('wheels/areas')->as('wheels.areas.')
  ->group(function () {
    Route::get('initTable', 'AreaTableController@init')->name('initTable');
    Route::get('tableData', 'AreaTableController@data')->name('tableData');
    Route::get('exportExcel', 'AreaTableController@excel')->name('exportExcel');
    Route::get('options', 'AreaSelectController@options')->name('options');
  });

Route::namespace ('Wheels\Areas')
  ->prefix('wheels')->as('wheels.')
  ->group(function () {
    Route::resource('areas', 'AreaController'); // if it's the case, use `except` or `only` to avoid generating unused routes
  });

// === OBSERVATIONS ============
Route::namespace ('Wheels\Observations')
  ->prefix('wheels/observations')->as('wheels.observations.')
  ->group(function () {
    Route::get('initTable', 'ObservationTableController@init')->name('initTable');
    Route::get('tableData', 'ObservationTableController@data')->name('tableData');
    Route::get('exportExcel', 'ObservationTableController@excel')->name('exportExcel');
    Route::get('options', 'ObservationSelectController@options')->name('options');
  });

Route::namespace ('Wheels\Observations')
  ->prefix('wheels')->as('wheels.')
  ->group(function () {
    Route::resource('observations', 'ObservationController'); // if it's the case, use `except` or `only` to avoid generating unused routes
  });

// === WHEELS =======================
Route::namespace ('Wheels\Wheels')
  ->prefix('wheels/wheels')->as('wheels.wheels.')
  ->group(function () {
    Route::get('initTable', 'WheelTableController@init')->name('initTable');
    Route::get('tableData', 'WheelTableController@data')->name('tableData');
    Route::get('exportExcel', 'WheelTableController@excel')->name('exportExcel');
    Route::get('options', 'WheelSelectController@options')->name('options');
  });

Route::namespace ('Wheels\Wheels')
  ->prefix('wheels')->as('wheels.')
  ->group(function () {
    Route::resource('wheels', 'WheelController'); // if it's the case, use `except` or `only` to avoid generating unused routes
  });
