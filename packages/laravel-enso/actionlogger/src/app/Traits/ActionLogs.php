<?php

namespace LaravelEnso\ActionLogger\app\Traits;

use LaravelEnso\ActionLogger\app\Models\ActionLog;

trait ActionLogs
{
    public function actionLogs()
    {
        return $this->hasMany(ActionLog::class);
    }
}
