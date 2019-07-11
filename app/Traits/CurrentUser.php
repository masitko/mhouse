<?php

namespace App\Traits;

use Illuminate\Auth\AuthenticationException;
use LaravelEnso\Core\app\Models\User;

trait CurrentUser {

  protected function getCurrentUser() {
    $user = session()->has('impersonating') ? User::find(session()->get('impersonating')) : auth()->user(); 
    if(!$user) {
      throw new AuthenticationException(__(
        'Your session expired, please login again.'
      ));
    }
    return $user;
  }

}
