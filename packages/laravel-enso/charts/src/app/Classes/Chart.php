<?php

namespace LaravelEnso\Charts\app\Classes;

use LaravelEnso\Helpers\app\Classes\Obj;

abstract class Chart
{
    protected $datasets;
    protected $labels;
    protected $colors;
    protected $data = [];
    protected $title;
    protected $type;
    protected $options;

    public function __construct()
    {
        $this->colors();
    }

    public function get()
    {
        $this->build();

        return $this->response();
    }

    abstract protected function build();

    abstract protected function response();

    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }

    public function labels(array $labels)
    {
        $this->labels = $labels;

        return $this;
    }

    public function datasets(array $datasets)
    {
        $this->datasets = $datasets;

        return $this;
    }

    public function ratio(float $ratio)
    {
        $this->options['aspectRatio'] = $ratio;

        return $this;
    }

    protected function type(string $type)
    {
        $this->type = $type;

        return $this;
    }

    protected function hex2rgba($color)
    {
        $color = substr($color, 1);
        $hex = [$color[0].$color[1], $color[2].$color[3], $color[4].$color[5]];
        $rgb = array_map('hexdec', $hex);

        return 'rgba('.implode(',', $rgb).','.config('enso.charts.fillBackgroundOpacity').')';
    }

    protected function color($index = null)
    {
        $index = $index ?? count($this->data);

        return $this->colors[$index];
    }

    protected function colors()
    {
        if (! $this->colors) {
            $this->colors = array_values(config('enso.charts.colors'));
        }

        return $this->colors;
    }

    protected function ticks()
    {
        $this->options['scales'] = new Obj(['xAxes' => [
            new Obj([
                'ticks' => [
                    'autoSkip' => false,
                    'maxRotation' => 90,
                ],
            ]),
        ]]);
    }
}
