<?php

namespace App\Tables\Builders\Wheels;

use App\Wheel;
use LaravelEnso\VueDatatable\app\Classes\Table;

class WheelTable extends Table
{
    protected $templatePath = __DIR__.'/../../Templates/Wheels/wheels.json';

    public function query()
    {
        return Wheel::select(\DB::raw('
            wheels.*, wheels.id as "dtRowId"
        '));
    }
}
