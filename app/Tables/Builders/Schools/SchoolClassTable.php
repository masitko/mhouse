<?php

namespace App\Tables\Builders\Schools;

use App\SchoolClass;
use App\Traits\CurrentUser;
use LaravelEnso\VueDatatable\app\Classes\Table;

class SchoolClassTable extends Table
{

  use CurrentUser;

  protected $templatePath = __DIR__ . '/../../Templates/Schools/schoolClasses.json';

  public function query()
  {
    if ($this->getCurrentUser())
      return SchoolClass::select(\DB::raw('
          school_classes.*, school_classes.id as "dtRowId"
        '))->where('school_id', $this->getCurrentUser()->school_id);
  }
}
