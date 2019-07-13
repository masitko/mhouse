<?php

namespace App\Http\Controllers\Schools\Exports;

use App\Tables\Builders\Schools\ExportTable;
use App\Http\Controllers\Controller;

use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;

use App\Observation;

class ExportTableController extends Controller
{
  use Datatable, Excel;

  protected $tableClass = ExportTable::class;

  private function prepareExcelParams($params)
  {
    // return $params;
    $pivotParams = json_decode($params['pivotParams']);
    $observations = $this->getObservations($pivotParams);
    $observations->each(function($observation) use (&$params){
      array_push($params['columns'], json_encode((object)[
        "name" => $observation->key,
        "label" => $observation->key,
        "data" => $observation->key,
        "meta" => (object)[
          "searchable" => false,
          "sortable" => false,
          "sort" => null,
          "total" => false,
          "date" => false,
          "translatable" => false,
          "nullLast" => false,
          "rogue" => false,
          "notExportable" => false
        ]
      ]));
    });
    return $params;
  }

  private function getObservations($params)
  {
    return Observation::select(
      'observations.*',
      'areas.name as area_name',
      "areas.order as area_order"
    )
      ->join('areas', 'observations.area_id',  '=',  'areas.id')
      ->whereIn('areas.id', $params->areas)
      ->orderBy('areas.order')
      ->orderBy('observations.order')
      ->get();
  }

}
