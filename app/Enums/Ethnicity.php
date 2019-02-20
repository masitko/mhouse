<?php

namespace App\Enums;

use LaravelEnso\Helpers\app\Classes\Enum;

class Ethnicity extends Enum
{
    const ABAN = 1;
    const AIND = 2;
    const AOTH = 3;
    const APKN = 4;
    const BAFR = 5;

    protected static $data = [
        self::ABAN => 'ABAN',
        self::AIND => 'AIND',
        self::AOTH => 'AOTH',
        self::APKN => 'APKN',
        self::BAFR => 'BAFR',
    ];
}
