<?php

namespace App\Http\Controllers\Schools\Terms;

use App\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaravelEnso\Select\app\Traits\OptionsBuilder;

class TermSelectController extends Controller
{
    use OptionsBuilder;

    protected $model = Term::class;

    public function query(Request $request)
    {
       return Term::query()->orderBy('start_date', 'DESC');
    }

}
