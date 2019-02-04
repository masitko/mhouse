<?php

namespace LaravelEnso\Schools\app\Tables\Builders;

use LaravelEnso\Schools\app\Models\School;
use LaravelEnso\VueDatatable\app\Classes\Table;

class CompanyTable extends Table
{
    const TemplatePath = __DIR__.'/../Templates/schools.json';

    public function query()
    {
        return School::select(\DB::raw(
                'schools.*, schools.id as "dtRowId", people.name as mandatary'
            ))->leftJoin('people', 'schools.mandatary_id', '=', 'people.id');
    }

    public function templatePath()
    {
        $file = config('enso.schools.tableTemplate');
        $templatePath = base_path($file);

        return $file && \File::exists($templatePath)
            ? $templatePath
            : self::TemplatePath;
    }
}
