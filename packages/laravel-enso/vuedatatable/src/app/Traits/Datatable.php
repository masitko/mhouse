<?php

namespace LaravelEnso\VueDatatable\app\Traits;

use Illuminate\Http\Request;

trait Datatable
{
    public function init(Request $request)
    {
        return (new $this->tableClass($request->all()))
            ->init();
    }

    public function data(Request $request)
    {
        return (new $this->tableClass($request->all()))
            ->data();
    }
}
