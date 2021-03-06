<?php

namespace App\Classes;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

use App\Outcome;
use App\Wheel;
use App\Area;
use App\Observation;
use App\User;
use App\Term;
use LaravelEnso\Charts\app\Classes\BarChart;

class Chart
{

  private $student;
  private $terms;
  private $wheel;
  private $areas;
  private $observations;
  private $outcomes;
  private $filters;
  private $datasets;
  private $labels;
  private $colors;

  public function __construct($filters)
  {
    $this->filters = $filters;
  }

  public function init()
  {

    $this->student = User::find($this->filters->userId);
    $this->terms = Term::whereIn('id', $this->filters->terms)->orderBy('start_date')->get();
    $this->wheel = Wheel::find($this->filters->wheelId);
    $definition = json_decode($this->wheel->definition);
    if (!$definition) {
      throw new ConflictHttpException(
        __("This wheel has no structure defined!")
      );
    }
    $this->areas = Area::whereIn('id', $definition->areas)->orderBy('order')->get();
    $this->observations = Observation::find($definition->observations);

    $this->outcomes = Outcome::whereIn('term_id', $this->filters->terms)
      ->where('wheel_id', $this->filters->wheelId)
      ->where('user_id', $this->filters->userId)
      ->get();

    return $this;
  }

  private function processData()
  {

    $this->labels = $this->terms->map(function ($term) {
      return $term->name;
    });

    $this->colors = $this->areas->map(function ($area) {
      return $area->colour;
    });

    // dd($this->colors);

    // assign obervations to correcponding areas
    $this->areas->transform(function ($area) {
      $area->observations = $this->observations->filter(function ($observation) use ($area) {
        return $area->id === $observation->area_id;
      })->map(function ($observation) {
        return $observation->id;
      })->values()->toArray();
      return $area;
    });

    $this->datasets = $this->areas->mapWithKeys(function ($area) {
      $data = $this->terms->map(function($term) use ($area){
        $outcome = $this->outcomes->firstWhere('term_id', $term->id);
        if( $outcome) {
          // dd($area->observations);
          $results = collect(json_decode($outcome->outcomes))
          ->filter(function($value, $key) use ($area){
            return in_array($key, $area->observations);
          })->sum();
          return $results;
          // dd($results->toArray());
        }
        else 
          return null;
        // return ;
      });
      return [$area->name => $data];
    });
  }

  public function getChart()
  {

    $this->processData();

    $chart = (new BarChart())
      ->title($this->student->name())
      ->labels($this->labels->toArray())
      ->datasets($this->datasets->toArray())
      ->setColors($this->colors->toArray())
      ->get();

    $chart['raw'] = [
      'wheel' => $this->wheel,
      'outcomes' => $this->outcomes,
      'areas' => $this->areas,
      'observations' => $this->observations,
      'outcomes' => $this->outcomes,
      'labels' => $this->labels,
      'datasets' => $this->datasets,
    ];

    return $chart;
  }
}
