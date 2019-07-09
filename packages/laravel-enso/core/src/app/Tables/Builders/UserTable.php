<?php

namespace LaravelEnso\Core\app\Tables\Builders;

use Illuminate\Support\Facades\Route;

use LaravelEnso\Core\app\Models\User;
use LaravelEnso\VueDatatable\app\Classes\Table;

use App\Traits\CurrentUser;

class UserTable extends Table {

  use CurrentUser;

  private const TemplatePath = __DIR__ . '/../Templates/';
  protected $templatePath;

  protected $type;

  public function __construct( array $request = [] )
  {
    // getting template corresponding to the route name (user, student, ...)
    $segments = explode( '.', Route::currentRouteName() );
    $this->type = $segments[1];
    $this->templatePath = self::TemplatePath . $this->type . '.json';
    parent::__construct($request);
  }

  public function query() {
    return User::select(\DB::raw(
      'users.id, users.id as "dtRowId", avatars.id as avatarId,
        schools.name as schoolName, schools.dfe as dfe, users.upn,
        users.first_name, users.last_name, users.phone, users.email,
        roles.name as role, users.admission_date,
        users.is_active, users.created_at'
    ))
    // ->join('people', 'users.person_id', '=', 'people.id')
      ->join('roles', 'users.role_id', '=', 'roles.id')
      ->where( 'roles.name', $this->type==='students'?'=':'<>', 'student')
      ->join('schools', 'users.school_id', '=', 'schools.id')
      ->where('schools.id', $this->getCurrentUser()->school_id)
      ->leftJoin('avatars', 'users.id', '=', 'avatars.user_id');
  }
}
