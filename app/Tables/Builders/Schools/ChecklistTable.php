<?php

namespace App\Tables\Builders\Schools;

use App\Outcome;
use App\Observation;
use LaravelEnso\VueDatatable\app\Classes\Table;
use Illuminate\Support\Collection;

class ChecklistTable extends Table
{
  protected $templatePath = __DIR__ . '/../../Templates/Schools/checklists.json';
  private $outcomeData = null;

  public function query()
  {
    // return Observation::select(\DB::raw('
    //   observations.*, observations.id as "dtRowId", areas.name as area_name
    // '))->leftJoin('areas', 'observations.area_id',  '=',  'areas.id');
    return Observation::select(
      "observations.*",
      'observations.id as dtRowId',
      "areas.name as area_name"
    )
      ->leftJoin('areas', 'observations.area_id',  '=',  'areas.id');
  }

  protected function processData($data)
  {
    $params = json_decode($this->request->pivotParams);
    if ($params->user->id && $params->term->id && $params->wheel->id) {
      if (!$this->outcomeData) {
        $this->outcomeData = Outcome::where('user_id', $params->user->id)
          ->where('term_id', $params->term->id)
          ->where('wheel_id', $params->wheel->id)
          ->get()->first();
      }
      if ($this->outcomeData) {
        $realData = isset($data['data']) ? $data['data'] : $data;
        $outcomes = json_decode($this->outcomeData->outcomes);
        $realData->transform(function ($observation) use ($outcomes) {
          $observation['outcome'] = $outcomes->{$observation['id']};
          return $observation;
        });
      }
    }
    // dd($data);
    return $data;
  }

  public function processExcelData($data)
  {
    return $this->processData($data);
  }
}
