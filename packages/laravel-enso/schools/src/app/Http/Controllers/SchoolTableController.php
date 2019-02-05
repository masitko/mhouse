<?php

namespace LaravelEnso\Schools\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use LaravelEnso\Schools\app\Tables\Builders\SchoolTable;

class SchoolTableController extends Controller
{
    use Datatable, Excel;

    protected $tableClass = SchoolTable::class;
}
