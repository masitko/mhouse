<?php

namespace App\Http\Controllers\Wheels\Areas;

use App\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaravelEnso\Select\app\Traits\OptionsBuilder;

class AreaSelectController extends Controller
{
    use OptionsBuilder;

    protected $model = Area::class;

    //protected $queryAttributes = ['name'];

    public function query(Request $request)
    {
       return Area::query()->orderBy('order');
    }
}
