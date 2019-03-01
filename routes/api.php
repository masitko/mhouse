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

// ====== TERMS ====================
Route::namespace ('Schools\Terms')
  ->prefix('schools/terms')->as('schools.terms.')
  ->group(function () {
    Route::get('initTable', 'TermTableController@init')->name('initTable');
    Route::get('tableData', 'TermTableController@data')->name('tableData');
    Route::get('exportExcel', 'TermTableController@excel')->name('exportExcel');
    Route::get('options', 'TermSelectController@options')->name('options');
  });

Route::namespace ('Schools\Terms')
  ->prefix('schools')->as('schools.')
  ->group(function () {
    Route::resource('terms', 'TermController'); // if it's the case, use `except` or `only` to avoid generating unused routes
  });

// ====== SCHOOLS ====================
Route::namespace ('Schools\Classes')
  ->prefix('schools/classes')->as('schools.classes.')
  ->group(function () {
    Route::get('initTable', 'SchoolClassTableController@init')->name('initTable');
    Route::get('tableData', 'SchoolClassTableController@data')->name('tableData');
    Route::get('exportExcel', 'SchoolClassTableController@excel')->name('exportExcel');
    Route::get('options', 'SchoolClassSelectController@options')->name('options');
  });

Route::namespace ('Schools\Classes')
  ->prefix('schools')->as('schools.')
  ->group(function () {
    Route::resource('classes', 'SchoolClassController'); // if it's the case, use `except` or `only` to avoid generating unused routes
  });

// ====== OUTCOMES ====================
Route::namespace ('Schools\Outcomes')
  ->prefix('schools/outcomes')->as('schools.outcomes.')
  ->group(function () {
    Route::get('initTable', 'OutcomeTableController@init')->name('initTable');
    Route::get('tableData', 'OutcomeTableController@data')->name('tableData');
    Route::get('exportExcel', 'OutcomeTableController@excel')->name('exportExcel');
    Route::get('options', 'OutcomeSelectController@options')->name('options');

    Route::get('getWheel', 'OutcomeController@getWheel')->name('getWheel');
    Route::post('storeWheel', 'OutcomeController@storeWheel')->name('storeWheel');
  });

Route::namespace ('Schools\Outcomes')
  ->prefix('schools')->as('schools.')
  ->group(function () {
    Route::resource('outcomes', 'OutcomeController'); // if it's the case, use `except` or `only` to avoid generating unused routes
  });
