<?php

namespace App\Http\Controllers\Wheels\Observations;

use App\Observation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaravelEnso\Select\app\Traits\OptionsBuilder;

class ObservationSelectController extends Controller
{
    use OptionsBuilder;

    protected $model = Observation::class;

    //protected $queryAttributes = ['name'];

    public function query(Request $request)
    {
       return Observation::query()->orderBy('order');
    }
}
