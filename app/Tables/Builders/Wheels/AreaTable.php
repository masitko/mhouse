<?php

namespace App\Tables\Builders\Wheels;

use App\Area;
use LaravelEnso\VueDatatable\app\Classes\Table;

class AreaTable extends Table
{
    protected $templatePath = __DIR__.'/../../Templates/Wheels/areas.json';

    public function query()
    {
        return Area::select(\DB::raw('
            areas.id as "dtRowId"
        '));
    }
}
