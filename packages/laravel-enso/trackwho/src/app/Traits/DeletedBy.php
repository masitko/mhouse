<?php

namespace LaravelEnso\TrackWho\app\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;

trait DeletedBy
{
    protected static function bootDeletedBy()
    {
        self::deleting(function ($model) {
            $events = $model->getEventDispatcher();

            tap($model)->unsetEventDispatcher()
                ->forceFill(
                    $model->getOriginal()
                    + ['deleted_by' => optional(auth()->user())->id]
            )->save();

            $model->setEventDispatcher($events);
        });
    }

    public function deletedBy() : Relation
    {
        return $this->belongsTo(
            config('auth.providers.users.model'), 'deleted_by'
        );
    }
}
