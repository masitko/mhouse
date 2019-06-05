<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthCode extends Model
{  
    //
    protected $guarded = [];

    protected $casts = [
      'confirmed' => 'boolean',
  ];    

}
