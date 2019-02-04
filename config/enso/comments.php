<?php

use LaravelEnso\Schools\app\Models\School;

return [
    'editableTimeLimit' => 24 * 60 * 60,
    'onDelete' => 'cascade',
    'loggableMorph' => [
        'commentable' => [
            School::class => 'name',
        ],
    ],
];
