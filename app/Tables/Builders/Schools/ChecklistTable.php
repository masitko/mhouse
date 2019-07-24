<?php

namespace App\Tables\Builders\Schools;

use Illuminate\Support\Str;

use App\Term;
use App\Outcome;
use App\Observation;
use LaravelEnso\VueDatatable\app\Classes\Table;
use LaravelEnso\VueDatatable\app\Classes\Template;

class ChecklistTable extends Table
{
  protected $templatePath = __DIR__ . '/../../Templates/Schools/checklists.json';
  private $outcomeData = null;
  private $outcomeTerm = [];

  public function init()
  {
    $template = (new Template($this->templatePath()))->get();
    $termIds = isset($this->request->terms) ? $this->request->terms : null;
    if ($termIds) {
      $terms = Term::orderBy('start_date')->findMany($termIds);
      // dd($terms);
      $terms->each(function ($term) use (&$template) {
        $template->columns->push((object) [
          "label" => $term->name,
          "name" => $term->name,
          "data" => $term->name,
          "meta" => (object) [
            "searchable" => false,
            "sortable" => false,
            "sort" => null,
            "total" => false,
            "date" => false,
            "translatable" => false,
            "nullLast" => false,
            "rogue" => false,
            "notExportable" => false,
            "visible" => true
          ]
        ]);
      });
    }
    // dd($template);
    return ['template' => $template];
  }

  public function query()
  {
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

    // dd($params);
    // if ($params->user->id && $params->term->id && $params->wheel->id) {
    //   if (!$this->outcomeData) {
    //     $this->outcomeData = Outcome::where('user_id', $params->user->id)
    //       ->where('term_id', $params->term->id)
    //       ->where('wheel_id', $params->wheel->id)
    //       ->get()->first();
    //   }
    //   if ($this->outcomeData) {
    //     $realData = isset($data['data']) ? $data['data'] : $data;
    //     $outcomes = json_decode($this->outcomeData->outcomes);
    //     $realData->transform(function ($observation) use ($outcomes) {
    //       $observation['outcome'] = $outcomes->{$observation['id']};
    //       return $observation;
    //     });
    //   }
    // }

    if (!empty($params->terms->id) && $params->user->id && $params->wheel->id) {
      $terms = Term::findMany($params->terms->id);
      foreach ($terms as $term) {
        // dd($term);
        if (empty($this->outcomeTerm[$term->name])) {
          $this->outcomeTerm[$term->name] = Outcome::where('user_id', $params->user->id)
            ->where('term_id', $term->id)
            ->where('wheel_id', $params->wheel->id)
            ->get()->first();
        }
        if ($this->outcomeTerm[$term->name]) {
          $realData = isset($data['data']) ? $data['data'] : $data;
          $outcomes = json_decode($this->outcomeTerm[$term->name]->outcomes);
          $realData->transform(function ($observation) use ($outcomes, $term) {
            $observation[$term->name] = $outcomes->{$observation['id']};
            return $observation;
          });
        }
      }
    }

    return $data;
  }

  public function processExcelData($data)
  {
    return $this->processData($data);
  }

  public function getExportFileName()
  {
    $params = json_decode($this->request->pivotParams);

    $fileName = $params->exportFileName ?
      $params->exportFileName : $this->request->get('name') . " Table Report";
    return preg_replace(
      '/[^A-Za-z0-9_.-]/',
      '_',
      Str::title(Str::snake($fileName))
    );
  }
}
