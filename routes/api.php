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
    Route::get('tableData', 'TermTableController@data')->name('tableData')->middleware('school.access');
    Route::get('exportExcel', 'TermTableController@excel')->name('exportExcel');
    Route::get('options', 'TermSelectController@options')->name('options')->middleware('school.access');
  });

Route::namespace ('Schools\Terms')
  ->prefix('schools')->as('schools.')
  ->group(function () {
    Route::resource('terms', 'TermController'); // if it's the case, use `except` or `only` to avoid generating unused routes
  });

// ====== SCHOOL CLASSES ====================
Route::namespace ('Schools\Classes')
  ->prefix('schools/classes')->as('schools.classes.')
  ->group(function () {
    Route::get('initTable', 'SchoolClassTableController@init')->name('initTable');
    Route::get('tableData', 'SchoolClassTableController@data')->name('tableData')->middleware('school.access');;
    Route::get('exportExcel', 'SchoolClassTableController@excel')->name('exportExcel');
    Route::get('options', 'SchoolClassSelectController@options')->name('options')->middleware('school.access');;
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
    Route::get('getWheel', 'OutcomeController@getWheel')->name('getWheel');
    Route::post('storeWheel', 'OutcomeController@storeWheel')->name('storeWheel');
  });

// ====== REPORTS ====================
Route::namespace ('Schools\Reports')
  ->prefix('schools/reports')->as('schools.reports.')
  ->group(function () {
    Route::get('getChart', 'ReportController@getChart')->name('getChart');
  });

// ====== EXPORTS ====================
Route::namespace ('Schools\Exports')
  ->prefix('schools/exports')->as('schools.exports.')
  ->group(function () {
    Route::get('initTable', 'ExportTableController@init')->name('initTable');
    Route::get('tableData', 'ExportTableController@data')->name('tableData');
    Route::get('exportExcel', 'ExportTableController@excel')->name('exportExcel');
  });

// ====== CHECKLISTS ====================
Route::namespace ('Schools\Checklists')
  ->prefix('schools/checklists')->as('schools.checklists.')
  ->group(function () {
    Route::get('initTable', 'ChecklistTableController@init')->name('initTable');
    Route::get('tableData', 'ChecklistTableController@data')->name('tableData');
    Route::get('exportExcel', 'ChecklistTableController@excel')->name('exportExcel');

  });

// Route::namespace ('Schools\Checklists')
//   ->prefix('schools')->as('checklists.')
//   ->group(function () {
//     Route::resource('checklists', 'ChecklistController'); // if it's the case, use `except` or `only` to avoid generating unused routes
//   });
