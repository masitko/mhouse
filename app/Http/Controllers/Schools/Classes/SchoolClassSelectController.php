<?php

namespace App\Http\Controllers\Schools\Classes;

use App\SchoolClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaravelEnso\Select\app\Traits\OptionsBuilder;

class SchoolClassSelectController extends Controller
{
    use OptionsBuilder;

    protected $model = SchoolClass::class;

    //protected $queryAttributes = ['name'];

    //public function query(Request $request)
    //{
    //    return SchoolClass::query();
    //}
}
