<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class Area extends Model {
  use LogsActivity;

  protected $fillable = ['name', 'description', 'order', 'colour'];

  protected $loggableLabel = 'name';

  protected $loggable = ['name', 'description'];

  public function observations() {
    return $this->hasMany(Observation::class, 'area_id');
  }

  public function associateObservations($newObservations) {
    foreach ($this->observations as $observation) {
      // dissociate only removed observations
      if (in_array($observation->id, $newObservations)) {
        // if association exist remove it from the list so we don't need to add it again
        $newObservations = array_diff($newObservations, [$observation->id]);
      } else {
        $observation->area()->dissociate($this)->save();
      }
    }
    // use updated list of observations to add only new asociations
    $observations = Observation::findMany($newObservations);
    foreach ($observations as $observation) {
      $observation->area()->associate($this)->save();
    }
  }

  public function delete() {
    if ($this->observations()->count()) {
      throw new ConflictHttpException(
        __("The area has observations attached and can't be deleted")
      );
    }

    parent::delete();
  }

}
