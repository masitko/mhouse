<?php

namespace App\Tables\Builders\Schools;

use App\Outcome;
use LaravelEnso\VueDatatable\app\Classes\Table;

class OutcomeTable extends Table
{
    protected $templatePath = __DIR__.'/../../Templates/Schools/outcomes.json';

    public function query()
    {
        return Outcome::select(\DB::raw('
            outcomes.id as "dtRowId"
        '));
    }
}
