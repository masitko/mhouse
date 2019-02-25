<?php

namespace App\Traits;

use LaravelEnso\Core\app\Models\User;

trait CurrentUser {

  protected function getCurrentUser() {
    return session()->has('impersonating') ? User::find(session()->get('impersonating')) : auth()->user();
  }

}
