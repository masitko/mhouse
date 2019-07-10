<?php

namespace App\Http\Controllers\Schools\Exports;

use App\Tables\Builders\Schools\ExportTable;
use App\Http\Controllers\Controller;

use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use Illuminate\Http\Request;

class ExportTableController extends Controller
{
  use Datatable, Excel;

  private $request;
  private $data;

  protected $tableClass = ExportTable::class;

  public function __construct(Request $request)
  {
    $this->request = $request->all();
  }

  public function customData()
  {
    $this->data = (new $this->tableClass($this->request))
      ->data();
    $params = json_decode($this->request['pivotParams']);
    // $this->prepareData($params);
    return $this->data;
  }

  private function prepareData($params)
  {
    $edgeDate = new \DateTime(date('Y').'-08-31');
    if ($edgeDate < new \DateTime()) {
      $edgeDate = new \DateTime((date('Y')+1).'-08-31');
    }

    $this->data['data']->transform(function($student) use($edgeDate){
      $bday = new \DateTime($student['birthday']);
      $student['age_group'] = $edgeDate->diff($bday)->y-5;
      return $student;
    });
  }


}
