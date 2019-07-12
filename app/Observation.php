<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;

class Observation extends Model
{
  use LogsActivity;

  protected $fillable = ['name', 'key', 'description', 'order', 'area_id'];

  protected $loggableLabel = 'name';

  protected $loggable = ['name', 'key'];

  public function area() {
    return $this->belongsTo(Area::class);
  }

}
