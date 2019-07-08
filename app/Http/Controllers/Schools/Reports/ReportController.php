<?php

namespace App\Http\Controllers\Schools\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use App\Classes\Chart;


class ReportController extends Controller
{

  public function getChart(Request $request)
  {

    $filters = json_decode($request->get('filters'));

    return (new Chart($filters))->init()->getChart();

  }
}
