<?php

namespace App\Tables\Builders\Wheels;

use App\Observation;
use LaravelEnso\VueDatatable\app\Classes\Table;

class ObservationTable extends Table
{
    protected $templatePath = __DIR__.'/../../Templates/Wheels/observations.json';

    public function query()
    {
        return Observation::select(\DB::raw('
          observations.*, observations.id as "dtRowId", areas.name as area_name
        '))->leftJoin('areas', 'observations.area_id',  '=',  'areas.id');
    }
}
