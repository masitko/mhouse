<?php

namespace App\Http\Controllers\Schools\Exports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Reports\ReportChart;


class ExportController extends Controller
{

  public function getChart(Request $request)
  {

    $filters = json_decode($request->get('filters'));

    return ['dupa'];
    return (new ReportChart($filters))->init()->getChart();

  }
}
