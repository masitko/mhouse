<?php

namespace App\Http\Controllers\Schools\Outcomes;

use App\Outcome;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaravelEnso\Select\app\Traits\OptionsBuilder;

class OutcomeSelectController extends Controller
{
    use OptionsBuilder;

    protected $model = Outcome::class;

    //protected $queryAttributes = ['name'];

    //public function query(Request $request)
    //{
    //    return Outcome::query();
    //}
}
