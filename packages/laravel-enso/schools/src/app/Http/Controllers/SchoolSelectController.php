<?php

namespace LaravelEnso\Schools\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\Schools\app\Models\School;
use LaravelEnso\Select\app\Traits\OptionsBuilder;

class SchoolSelectController extends Controller
{
    use OptionsBuilder;

    public function query(Request $request)
    {
        $query = School::query();

        // if (! $request->user()->belongsToAdminGroup()
        //     && $request->user()->person->school_id) {
        //     $query->whereId($request->user()->person->school_id);
        // }

        return $query;
    }
}
