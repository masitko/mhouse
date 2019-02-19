<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;

class Term extends Model
{
  use LogsActivity;

  protected $guarded = [];

  // protected $dateFormat = 'd-m-Y';
  protected $dates = ['start_date', 'end_date'];

  protected $loggableLabel = 'name';

  protected $loggable = ['name', 'start_date', 'end_date'];

  public function setStartDateAttribute($value)
  {
      $this->attributes['start_date'] = isset($value)
          ? Carbon::parse($value)
          : null;
  }

  public function setEndDateAttribute($value)
  {
      $this->attributes['end_date'] = isset($value)
          ? Carbon::parse($value)
          : null;
  }

  public function school() {
    return $this->belongsTo(School::class);
  }
}
