<?php

Route::namespace('LaravelEnso\Schools\app\Http\Controllers')
    ->middleware(['web', 'auth', 'core'])
    ->prefix('api/administration')
    ->as('administration.')
    ->group(function () {
        Route::prefix('schools')->as('schools.')
            ->group(function () {
                Route::get('initTable', 'CompanyTableController@init')
                    ->name('initTable');
                Route::get('tableData', 'CompanyTableController@data')
                    ->name('tableData');
                Route::get('exportExcel', 'CompanyTableController@excel')
                    ->name('exportExcel');

                Route::get('options', 'CompanySelectController@options')
                    ->name('options');

                Route::prefix('{school}/people')->as('people.')
                    ->group(function () {
                        Route::get('', 'PersonController@index')
                            ->name('index');
                        Route::get('create', 'PersonController@create')
                            ->name('create');
                    });

                Route::prefix('people')->as('people.')
                    ->group(function () {
                        Route::get('{person}/edit', 'PersonController@edit')
                            ->name('edit');
                        Route::patch('{person}', 'PersonController@update')
                            ->name('update');
                        Route::post('store', 'PersonController@store')
                            ->name('store');
                        Route::delete('{person}', 'PersonController@destroy')
                            ->name('destroy');
                    });
            });

        Route::resource('schools', 'CompanyController', ['except' => ['index', 'show']]);
    });
