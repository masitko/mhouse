<?php

return [
  /*
    |--------------------------------------------------------------------------
    | Validations
    |--------------------------------------------------------------------------
    | This flag sets whether validations are also executed in production
    | or only in local/development.
    | Values: 'always/local/yourEnv...'
    |
    */

  'validations' => 'always',

  /*
    |--------------------------------------------------------------------------
    | Chunk Size
    |--------------------------------------------------------------------------
    | The default row chunk for the import queued jobs. Can be overwritten
    | per template.
    |
    */

  'chunkSize' => 1000,

  /*
    |--------------------------------------------------------------------------
    | Chunk Splitting Queue
    |--------------------------------------------------------------------------
    | Specifies the queue for the chunk splitting job. Can be set
    | specifically for every import in its template
    |
    */

  'splittingQueue' => 'split',

  /*
    |--------------------------------------------------------------------------
    | Queues
    |--------------------------------------------------------------------------
    | Specifies the queue for each type of job during the import process.
    | The splitting process will be the longest and should be set
    | to a larger value.
    */

  'queues' => [
    'splitting' => 'heavy',
    'processing' => 'light',
    'rejected' => 'heavy',
    'notifications' => 'notifications',
  ],

  /*
    |--------------------------------------------------------------------------
    | Timeout
    |--------------------------------------------------------------------------
    | Sets the default timeout used for chunk splitting jobs & rejected
    | summary export. It can be overwritten in the import's template.
    |
    */

  'timeout' => 60 * 4,

  /*
    |--------------------------------------------------------------------------
    | Error Column
    |--------------------------------------------------------------------------
    | Each import with failed entries will generate a rejected xlsx report
    | with the same structure as the import and an extra errors column.
    | This flag sets the name of the errors column.
    |
    */

  'errorColumn' => '_errors',

  /*
    |--------------------------------------------------------------------------
    | Notification channels
    |--------------------------------------------------------------------------
    | After each import the user will be notified by email. Additionally
    | a notification can be broadcasted to the user.
    | ** I've removed default notification by email, 
    |    it can be added to the array as 'mail'
    */

  'notifications' => ['broadcast', 'database'],

  /*
    |--------------------------------------------------------------------------
    | Configurations
    |--------------------------------------------------------------------------
    | Holds your import configuration. 'label' is used for the main page select
    | and template is the full path to your import template JSON.
    |
    */

  'configs' => [
    // 'userGroups' => [
    //     'label' => 'User Groups 4',
    //     'template' => 'vendor/laravel-enso/dataimport/src/app/Tests/userGroups.json',
    // ],
    'users' => [
      'label' => 'Users',
      'template' => 'app/Imports/Templates/users.json',
    ],
    'students' => [
      'label' => 'Students',
      'template' => 'app/Imports/Templates/students.json',
    ],
  ],
];
