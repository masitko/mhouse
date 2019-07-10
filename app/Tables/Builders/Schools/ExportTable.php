<?php

namespace App\Tables\Builders\Schools;

use App\User;
use LaravelEnso\VueDatatable\app\Classes\Table;

use App\Traits\CurrentUser;

class ExportTable extends Table
{
  use CurrentUser;

  protected $templatePath = __DIR__ . '/../../Templates/Schools/export-students.json';

  public function query()
  {

    $edgeDate = new \DateTime(date('Y').'-08-31');
    if ($edgeDate < new \DateTime()) {
      $edgeDate = new \DateTime((date('Y')+1).'-08-31');
    }

    return User::selectRaw(
      'users.id as "dtRowId", avatars.id as avatarId,
        schools.name as schoolName, schools.dfe as dfe, users.upn,
        users.first_name, users.last_name, users.phone,
        roles.name as role, users.admission_date,
        users.is_active, users.created_at, users.birthday, '.
        "TIMESTAMPDIFF(YEAR, users.birthday, '".$edgeDate->format('Y-m-d'). "')-5 AS age_group"        
    )
      ->join('roles', 'users.role_id', '=', 'roles.id')
      ->where( 'roles.name', 'student')
      ->join('schools', 'users.school_id', '=', 'schools.id')
      ->where('schools.id', $this->getCurrentUser()->school_id)
      ->leftJoin('avatars', 'users.id', '=', 'avatars.user_id');

    // return Observation::select(\DB::raw('
    //   observations.*, observations.id as "dtRowId", areas.name as area_name
    // '))->leftJoin('areas', 'observations.area_id',  '=',  'areas.id');
  }
}
