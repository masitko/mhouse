<?php

namespace App\Http\Controllers\Schools\Classes;

use App\Tables\Builders\Schools\SchoolClassTable;
use App\Http\Controllers\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;

class SchoolClassTableController extends Controller
{
    use Datatable, Excel;

    protected $tableClass = SchoolClassTable::class;
}
