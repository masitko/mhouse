<?php

namespace App\Http\Controllers\Schools\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Reports\ReportChart;


class ReportController extends Controller
{

  public function getChart(Request $request)
  {

    $filters = json_decode($request->get('filters'));

    return (new ReportChart($filters))->init()->getChart();

  }
}
