<?php

use LaravelEnso\Schools\app\Models\School;

return [
    'onDelete' => 'cascade',
    'loggableMorph' => [
        'discussable' => [
            School::class => 'name',
        ],
    ],
];
