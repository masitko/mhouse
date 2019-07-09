<?php

namespace LaravelEnso\Core\app\Http\Controllers\Administration\User;


use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller;
use LaravelEnso\Core\app\Models\User;

use LaravelEnso\Select\app\Traits\OptionsBuilder;
use App\Traits\CurrentUser;


class UserSelectController extends Controller
{
  use OptionsBuilder, CurrentUser;

  protected $type;

  protected $trackBy = "users.id";

  protected $queryAttributes = [
    'first_name', 'last_name'
  ];

  public function __construct(array $request = [])
  {
    // getting template corresponding to the route name (user, student, ...)
    $segments = explode('.', Route::currentRouteName());
    $this->type = $segments[1];
  }

  public function query()
  {
    return User::active()
      ->selectRaw("users.*, CONCAT(first_name, ' ', last_name) as name")
      ->join('roles', 'users.role_id', '=', 'roles.id')
      ->where('roles.name', $this->type === 'students' ? '=' : '<>', 'student')
      ->join('schools', 'users.school_id', '=', 'schools.id')
      ->where('schools.id', $this->getCurrentUser()->school_id)
      //
    ;
  }
}
