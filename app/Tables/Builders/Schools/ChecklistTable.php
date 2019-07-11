<?php

namespace App\Tables\Builders\Schools;

use App\Outcome;
use App\Observation;
use LaravelEnso\VueDatatable\app\Classes\Table;

class ChecklistTable extends Table
{
  protected $templatePath = __DIR__ . '/../../Templates/Schools/checklists.json';

  public function query()
  {
    return Observation::select(\DB::raw('
      observations.*, observations.id as "dtRowId", areas.name as area_name
    '))->leftJoin('areas', 'observations.area_id',  '=',  'areas.id');
  }

  protected function processData($data){
    $params = json_decode($this->request->pivotParams);
    if ($params->user->id && $params->term->id && $params->wheel->id) {
      $outcomeData = Outcome::where('user_id', $params->user->id)
        ->where('term_id', $params->term->id)
        ->where('wheel_id', $params->wheel->id)
        ->get()->first();
      if ($outcomeData) {
        $outcomes = json_decode($outcomeData->outcomes);
        $data['data']->transform(function ($observation) use ($outcomes) {
          $observation['outcome'] = $outcomes->{$observation['id']};
          return $observation;
        });
      }
    }
    return $data;
  }

}
