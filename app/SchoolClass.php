<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;

class SchoolClass extends Model
{
  use LogsActivity;

  protected $fillable = ['name', 'notes', 'age', 'school_id'];

  protected $loggableLabel = 'name';

  protected $loggable = ['name', 'notes'];

  public function school() {
    return $this->belongsTo(School::class);
  }
}
