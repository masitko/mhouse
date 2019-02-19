<?php

namespace App\Tables\Builders\Schools;

use App\Term;
use LaravelEnso\VueDatatable\app\Classes\Table;

class TermTable extends Table
{
    protected $templatePath = __DIR__.'/../../Templates/Schools/terms.json';

    public function query()
    {
        return Term::select(\DB::raw('
            terms.id as "dtRowId"
        '));
    }
}
