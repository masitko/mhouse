<?php

namespace App\Imports\Importers;

use LaravelEnso\Core\app\Models\User;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\People\app\Enums\Titles;
use LaravelEnso\People\app\Enums\Genders;
use App\Enums\Ethnicity;

use LaravelEnso\Helpers\app\Classes\Obj;
use LaravelEnso\DataImport\app\Contracts\Importable;
use LaravelEnso\DataImport\app\Contracts\AfterHook; // optional
use LaravelEnso\DataImport\app\Contracts\BeforeHook; // optional

class StudentImporter implements Importable, BeforeHook, AfterHook
{
  private $roles;

  public function before(Obj $params) // optional
  {
    // optional logic to be executed before the import is started
  }

  public function run(Obj $row, Obj $param)
  {
    $row->school_id = $param->school_id;
    $row->role_id = Role::whereName('student')->first()->id;
    $row->gender = $row->gender?Genders::select()->pluck('id', 'name')->get($row->gender):null;
    $row->title = $row->title?Titles::select()->pluck('id', 'name')->get($row->title):null;
    $row->ethnicity = $row->ethnicity?Ethnicity::select()->pluck('id', 'name')->get($row->ethnicity):null;
    $row->flag_fsm = strtolower($row->flag_fsm) == 'yes';
    $row->post_cla = strtolower($row->post_cla) == 'yes';
    $row->flag_cla = strtolower($row->flag_cla) == 'yes';
    $row->flag_sen = strtolower($row->flag_sen) == 'yes';
    $row->birthday = $row->birthday?$row->birthday:NULL;
    $row->admission_date = $row->admission_date?$row->admission_date:NULL;
    $row->is_active = true;
    \Log::debug($row);
    \Log::debug($param);
    // \Log::debug(Titles::select());
    $current = User::firstOrNew(['email' => $row->email])
      ->fill((array)$row);
    $current->setPassword($row->password?bcrypt($row->password):null);
    $current->save();

    \Log::debug($current);
  }

  public function after(Obj $params) // optional
  {
    // optional logic to be executed after the import has finished
  }
}
