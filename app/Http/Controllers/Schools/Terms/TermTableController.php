<?php

namespace App\Http\Controllers\Schools\Terms;

use App\Tables\Builders\Schools\TermTable;
use App\Http\Controllers\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;

class TermTableController extends Controller
{
    use Datatable, Excel;

    protected $tableClass = TermTable::class;
}
