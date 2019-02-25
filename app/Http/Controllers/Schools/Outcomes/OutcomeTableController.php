<?php

namespace App\Http\Controllers\Schools\Outcomes;

use App\Tables\Builders\Schools\OutcomeTable;
use App\Http\Controllers\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;

class OutcomeTableController extends Controller
{
    use Datatable, Excel;

    protected $tableClass = OutcomeTable::class;
}
