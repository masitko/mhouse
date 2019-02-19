<?php

namespace App\Tables\Builders\Schools;

use App\SchoolClass;
use LaravelEnso\VueDatatable\app\Classes\Table;

class SchoolClassTable extends Table
{
    protected $templatePath = __DIR__.'/../../Templates/Schools/schoolClasses.json';

    public function query()
    {
        return SchoolClass::select(\DB::raw('
          school_classes.*, school_classes.id as "dtRowId"
        '));
    }
}
