<?php

namespace App\Tables\Builders\Schools;

use App\Term;
use LaravelEnso\VueDatatable\app\Classes\Table;

use App\Traits\CurrentUser;

class TermTable extends Table
{

  use CurrentUser;

  protected $templatePath = __DIR__ . '/../../Templates/Schools/terms.json';

  public function query()
  {
    return Term::select(\DB::raw('terms.*, terms.id as "dtRowId"'));
  }
}
