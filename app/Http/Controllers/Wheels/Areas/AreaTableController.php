<?php

namespace App\Http\Controllers\Wheels\Areas;

use App\Tables\Builders\Wheels\AreaTable;
use App\Http\Controllers\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;

class AreaTableController extends Controller
{
    use Datatable, Excel;

    protected $tableClass = AreaTable::class;
}
