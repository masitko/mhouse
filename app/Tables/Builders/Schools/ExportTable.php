<?php

namespace App\Tables\Builders\Schools;

use Illuminate\Support\Str;
use LaravelEnso\VueDatatable\app\Classes\Table;

use App\Observation;
use App\User;

use App\Traits\CurrentUser;

class ExportTable extends Table
{
  use CurrentUser;

  protected $templatePath = __DIR__ . '/../../Templates/Schools/export-students.json';
  private $observations = null;

  public function query()
  {
    $params = json_decode($this->request->pivotParams);

    $edgeDate = new \DateTime(date('Y') . '-09-01');
    if ($edgeDate < new \DateTime()) {
      $edgeDate = new \DateTime((date('Y') + 1) . '-09-01');
    }

    $query = User::select(
      'users.id as dtRowId',
      'avatars.id as avatarId',
      'schools.dfe as dfe',
      'users.upn',
      'users.first_name',
      'users.last_name',
      'users.email',
      'users.admission_date',
      'users.is_active',
      'users.created_at',
      'users.birthday',
      'outcomes.outcomes',
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

    if (sizeof($params->ageGroups)) {
      $query->whereRaw("TIMESTAMPDIFF(YEAR, users.birthday, '" . $edgeDate->format('Y-m-d') . "')-5 in (" . join(",", $params->ageGroups) . ")");
    }
    return $query;
  }

  public function processExcelData($data)
  {
    if (!$this->observations) {
      $params = json_decode($this->request->pivotParams);
      $this->observations = Observation::select(
        "observations.*",
        'observations.id as dtRowId',
        "areas.name as area_name"
      )
        ->leftJoin('areas', 'observations.area_id',  '=',  'areas.id')
        ->whereIn('areas.id', $params->areas)
        ->get();
    }
    if ($this->observations) {
      $data->transform(function ($student) {
        $outcomes = collect(json_decode($student['outcomes']));
        $outcomes->each(function ($outcome, $index) use (&$student) {
          $key = ($this->observations->firstWhere('id', $index))['key'];
          $student[$key] = $outcome;
        });
        return $student;
      });
    }
    return $this->processData($data);
  }

  public function getExportFileName()
  {
    $params = json_decode($this->request->pivotParams);

    $fileName = $params->exportFileName ?
      $params->exportFileName : $this->request->get('name') . " Table Report";
    return preg_replace(
      '/[^A-Za-z0-9_.-]/',
      '_',
      Str::title(Str::snake($fileName))
    );
  }
}
