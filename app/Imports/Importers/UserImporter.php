<?php

namespace App\Imports\Importers;

use LaravelEnso\Core\app\Models\User;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\People\app\Enums\Titles;
use LaravelEnso\People\app\Enums\Genders;

use LaravelEnso\Helpers\app\Classes\Obj;
use LaravelEnso\DataImport\app\Contracts\Importable;
use LaravelEnso\DataImport\app\Contracts\AfterHook; // optional
use LaravelEnso\DataImport\app\Contracts\BeforeHook; // optional

class UserImporter implements Importable, BeforeHook, AfterHook
{
  private $roles;

  public function before(Obj $params) // optional
  {
    // optional logic to be executed before the import is started
  }

  public function run(Obj $row, Obj $param)
  {
    $row->school_id = $param->school_id;
    $row->role_id = Role::whereName($row->role)->first()->id;
    $row->gender = Genders::select()->pluck('id', 'name')->get($row->gender);
    $row->title = Titles::select()->pluck('id', 'name')->get($row->title);
    // if( $row->password ) 
    //   $row->password = ;
    $row->is_active = true;
    \Log::debug($row);
    \Log::debug($param);
    // \Log::debug(Titles::select());
    $current = User::firstOrNew(['email' => $row->email])
      ->fill((array)$row);
    $current->setPassword(bcrypt($row->password));
    $current->save();

    \Log::debug($current);
  }

  public function after(Obj $params) // optional
  {
    // optional logic to be executed after the import has finished
  }
}
