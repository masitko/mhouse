<?php

namespace App\Enums;

use LaravelEnso\Helpers\app\Classes\Enum;

class Genders extends Enum
{
    const Female = 1;
    const Male = 2;

    protected static $data = [
        self::Female => 'Female',
        self::Male => 'Male',
    ];
}
