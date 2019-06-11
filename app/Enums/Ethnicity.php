<?php

namespace App\Enums;

use LaravelEnso\Helpers\app\Classes\Enum;

class Ethnicity extends Enum
{
    const ABAN = 10;
    const AIND = 20;
    const AOTH = 30;
    const APKN = 40;
    const BAFR = 50;
 
    const BCRB = 60;
    const BOTH = 70;
    const CHNE = 80;
    const MOTH = 90;
    const MWAS = 100;
 
    const MWBA = 110;
    const MWBC = 120;
    const NOBT = 130;
    const OOTH = 140;
    const REFU = 150;

    const WBRI = 160;
    const WIRI = 170;
    const WIRT = 180;
    const WOTH = 190;
    const WROM = 200;

    protected static $data = [
        self::ABAN => 'ABAN',
        self::AIND => 'AIND',
        self::AOTH => 'AOTH',
        self::APKN => 'APKN',
        self::BAFR => 'BAFR',
 
        self::BCRB => 'BCRB',
        self::BOTH => 'BOTH',
        self::CHNE => 'CHNE',
        self::MOTH => 'MOTH',
        self::MWAS => 'MWAS',

        self::MWBA => 'MWBA',
        self::MWBC => 'MWBC',
        self::NOBT => 'NOBT',
        self::OOTH => 'OOTH',
        self::REFU => 'REFU',

        self::WBRI => 'WBRI',
        self::WIRI => 'WIRI',
        self::WIRT => 'WIRT',
        self::WOTH => 'WOTH',
        self::WROM => 'WROM',
    ];
}
