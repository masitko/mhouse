<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\TrackWho\app\Traits\UpdatedBy;



class Outcome extends Model
{
  use CreatedBy, UpdatedBy;
    //

    
}
