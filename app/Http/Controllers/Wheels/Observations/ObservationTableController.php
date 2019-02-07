<?php

namespace App\Http\Controllers\Wheels\Observations;

use App\Tables\Builders\Wheels\ObservationTable;
use App\Http\Controllers\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;

class ObservationTableController extends Controller
{
    use Datatable, Excel;

    protected $tableClass = ObservationTable::class;
}
