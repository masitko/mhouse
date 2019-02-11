<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class Area extends Model
{
  use LogsActivity;

  protected $fillable = ['name', 'description', 'order', 'colour'];

  protected $loggableLabel = 'name';

  protected $loggable = ['name', 'description'];

  public function observations()
  {
      return $this->hasMany(Observation::class, 'area_id');
  }

  public function updateWithObservations(array $attributes)
  {
      tap($this)->update($attributes);
      foreach($this->observations as $observation) {
        $observation->area()->dissociate($this)->save();
      }
      
      $observations = Observation::findMany($attributes['observations']);
      foreach($observations as $observation) {
        $observation->area()->associate($this)->save();
      }

          // ->observations()
          // ->sync($attributes['observations']);
  }

  public function delete()
  {
      if ($this->observations()->count()) {
          throw new ConflictHttpException(
              __("The area has observations attached and can't be deleted")
          );
      }

      parent::delete();
  }

}
