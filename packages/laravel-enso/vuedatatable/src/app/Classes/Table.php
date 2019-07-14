<?php

namespace LaravelEnso\VueDatatable\app\Classes;

use Illuminate\Support\Str;
use LaravelEnso\Helpers\app\Classes\Obj;
use LaravelEnso\VueDatatable\app\Classes\Table\Builder;

abstract class Table
{
  protected $request;
  protected $templatePath;
  protected $query;

  public function __construct(array $request = [])
  {
    $this->request = new Obj(json_decode(json_encode($request), true));
  }

  abstract public function query();

  public function request()
  {
    return $this->request;
  }

  public function init()
  {
    return ['template' => (new Template($this->templatePath()))->get()];
  }

  public function data()
  {
    return $this->processData($this->builder()->data());
  }

  protected function processData($data)
  {
    return $data;
  }

  public function processExcelData($data)
  {
    return $data;
  }

  public function getExportFileName()
  {
    return preg_replace(
      '/[^A-Za-z0-9_.-]/',
      '_',
      Str::title(Str::snake($this->request->get('name')))
        . '_' . __('Table_Report')
    );
  }

  public function fetcher()
  {
    return $this->builder()
      ->fetcher();
  }

  public function templatePath()
  {
    return $this->templatePath;
  }

  private function setPivotParams()
  {
    $params = json_decode($this->request);
    if (isset($params->pivotParams)) {
      collect(json_decode($params->pivotParams))
        ->each(function ($param, $relation) {
          $model = $this->query->getModel();
          if (method_exists($model, $relation))
            $this->query->whereHas($relation, function ($query) use ($param) {
              collect($param)->each(
                function ($value, $attribute) use ($query) {
                  $query->whereIn($attribute, (array) $value);
                }
              );
            });
        });
    }
  }

  private function builder()
  {
    $this->query = $this->query();
    $this->setPivotParams();

    return new Builder($this->request, $this->query);
  }
}
