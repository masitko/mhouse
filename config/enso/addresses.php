<?php

use LaravelEnso\Schools\app\Models\School;

return [
    'onDelete' => 'cascade',
    'formTemplate' => null,
    'loggableMorph' => [
        'addressable' => [
            School::class => 'name',
        ],
    ],
    'streetTypes' => [
        'Street' => 'Street',
        'Avenue' => 'Avenue',
        'Boulevard' => 'Boulevard',
        'Parade' => 'Parade',
        'Road' => 'Road',
        'Lane' => 'Lane',
        'Route' => 'Route',
        'Row' => 'Row',
        'Vista' => 'Vista',
        'Bend' => 'Bend',
        'Square' => 'Square',
    ],
    'buildingTypes' => [
        'Offices' => 'Offices',
        'Residential' => 'Residential',
        'Comercial' => 'Comercial',
        'Industrial' => 'Industrial',
    ],
    'label' => [
        'separator' => ' - ',
        'attributes' => [
            'localityName', 'street', 'number',
        ],
    ],
];
