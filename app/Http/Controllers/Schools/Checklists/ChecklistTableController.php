<?php

namespace App\Http\Controllers\Schools\Checklists;

use App\Tables\Builders\Schools\ChecklistTable;
use App\Http\Controllers\Controller;
// use App\Outcome;

use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
// use Illuminate\Http\Request;

class ChecklistTableController extends Controller
{
  use Datatable, Excel;

  // private $request;
  // private $data;

  protected $tableClass = ChecklistTable::class;

  // public function __construct(Request $request)
  // {
  //   $this->request = $request->all();
  // }

  // public function customData()
  // {
  //   $this->data = (new $this->tableClass($this->request))
  //     ->data();
  //   $params = json_decode($this->request['pivotParams']);
  //   $this->fillOutcomes($params);
  //   return $this->data;
  // }

  // private function fillOutcomes($params)
  // {
  //   if ($params->user->id && $params->term->id && $params->wheel->id) {
  //     $outcomeData = Outcome::where('user_id', $params->user->id)
  //       ->where('term_id', $params->term->id)
  //       ->where('wheel_id', $params->wheel->id)
  //       ->get()->first();
  //     if ($outcomeData) {
  //       $outcomes = json_decode($outcomeData->outcomes);
  //       $this->data['data']->transform(function ($observation) use ($outcomes) {
  //         $observation['outcome'] = $outcomes->{$observation['id']};
  //         return $observation;
  //       });
  //     }
  //   }
  // }
}
