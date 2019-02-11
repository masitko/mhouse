<?php

namespace App\Http\Controllers\Wheels\Wheels;

use App\Tables\Builders\Wheels\WheelTable;
use App\Http\Controllers\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;

class WheelTableController extends Controller
{
    use Datatable, Excel;

    protected $tableClass = WheelTable::class;
}
