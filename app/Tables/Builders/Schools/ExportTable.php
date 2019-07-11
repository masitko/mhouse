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

    $params = json_decode($this->request->pivotParams);
    // dd($params);

    $edgeDate = new \DateTime(date('Y') . '-09-01');
    if ($edgeDate < new \DateTime()) {
      $edgeDate = new \DateTime((date('Y') + 1) . '-09-01');
    }

    $query = User::select(
      'users.id as dtRowId', 'avatars.id as avatarId',
        'schools.dfe as dfe', 'users.upn',
        'users.first_name', 'users.last_name', 'users.admission_date',
        'users.is_active', 'users.created_at', 'users.birthday', 
        // 'outcomes.outcomes',
        \DB::raw("GREATEST(TIMESTAMPDIFF(YEAR, users.birthday, '" . $edgeDate->format('Y-m-d') . "')-5, 0) AS age_group")
    )
      ->where('users.is_active', true)
      ->join('outcomes', 'outcomes.user_id', '=', 'users.id')
      ->where('outcomes.term_id', $params->termId)
      ->where('outcomes.wheel_id', $params->wheelId)
      ->join('roles', 'users.role_id', '=', 'roles.id')
      ->where('roles.name', 'student')
      ->join('schools', 'users.school_id', '=', 'schools.id')
      ->where('schools.id', $this->getCurrentUser()->school_id)
      ->leftJoin('avatars', 'users.id', '=', 'avatars.user_id');

    if( sizeof($params->ageGroups) ) {
      $query->whereRaw("TIMESTAMPDIFF(YEAR, users.birthday, '" . $edgeDate->format('Y-m-d') . "')-5 in (".join(",",$params->ageGroups).")");
    }
    return $query;
    // return Observation::select(\DB::raw('
    //   observations.*, observations.id as "dtRowId", areas.name as area_name
    // '))->leftJoin('areas', 'observations.area_id',  '=',  'areas.id');
  }
}
