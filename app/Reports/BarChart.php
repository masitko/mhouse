<?php

namespace App\Reports;
use LaravelEnso\Charts\app\Classes\Chart;

class BarChart extends Chart
{
  public function __construct($options = [])
  {
    parent::__construct();

    $this->type('bar')
      ->ratio(1.6)
      ->ticks();
      $this->options['hover']['mode'] = 'nearest';
      // dd($this->options);
      $this->options['scales']['yAxes'][0]['scaleLabel'] = [
        'display' => true,
        'labelString' => 'Percentage',
      ];
        // 'Percentage'
      
  }

  protected function response()
  {
    return [
      'data' => [
        'labels' => $this->labels,
        'datasets' => $this->data,
      ],
      'options' => $this->options,
      'title' => $this->title,
      'type' => $this->type,
    ];
  }

  public function stackedScales()
  {
    $this->options['scales'] = [
      'xAxes' => [
        ['stacked' => true],
      ],
      'yAxes' => [
        ['stacked' => true],
      ],
    ];

    return $this;
  }

  protected function build()
  {
    collect($this->datasets)->each(function ($dataset, $label) {
      $color = $this->color();
      $this->data[] = [
        'label' => $label,
        'borderColor' => $this->hex2rgba($color, 0.7),
        'borderWidth' => 1,        
        'backgroundColor' => $this->hex2rgba($color, 0.3),

        'hoverBorderWidth' => 1,
        // 'hoverBorderColor' => $color,
        'hoverBackgroundColor' => $this->hex2rgba($color, 0.4),

        'data' => $dataset,
        'datalabels' => [
          'borderWidth' => 1,
          'borderColor' => $this->hex2rgba($color, 0.7),
          'backgroundColor' => $this->hex2rgba($color, 0.3 ),
          'color' => 'black',
        ],
      ];
    });
  }
}
