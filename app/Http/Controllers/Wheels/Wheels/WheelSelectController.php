<?php

namespace App\Http\Controllers\Wheels\Wheels;

use App\Wheel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaravelEnso\Select\app\Traits\OptionsBuilder;

class WheelSelectController extends Controller
{
    use OptionsBuilder;

    protected $model = Wheel::class;

    //protected $queryAttributes = ['name'];

    //public function query(Request $request)
    //{
    //    return Wheel::query();
    //}
}
