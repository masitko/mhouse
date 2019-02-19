<?php

namespace LaravelEnso\Core\app\Models;

use Illuminate\Notifications\Notifiable;
// use LaravelEnso\People\app\Models\Person;
// use LaravelEnso\People\app\Traits\IsPerson;
use LaravelEnso\Core\app\Traits\HasPassword;
use LaravelEnso\FileManager\app\Models\File;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\FileManager\app\Traits\Uploads;
use LaravelEnso\Helpers\app\Traits\ActiveState;
use LaravelEnso\ActionLogger\app\Traits\ActionLogs;
use LaravelEnso\AvatarManager\app\Traits\HasAvatar;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;
use LaravelEnso\Core\app\Classes\DefaultPreferences;
use LaravelEnso\Impersonate\app\Traits\Impersonates;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\TrackWho\app\Traits\UpdatedBy;
use LaravelEnso\AddressesManager\app\Traits\Addressable;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use LaravelEnso\Schools\app\Models\School;

class User extends Authenticatable
{
  use
    ActionLogs,
    ActiveState,
    Addressable,
    CreatedBy,
    UpdatedBy,
    HasAvatar,
    HasPassword,
    Impersonates,
        // IsPerson, 
    LogsActivity,
    Notifiable,
    Uploads;

  protected $hidden = ['password', 'remember_token', 'password_updated_at'];

    // protected $fillable = ['person_id', 'group_id', 'role_id', 'email', 'is_active'];
  protected $fillable = [
    'role_id',
    'first_name', 'last_name', 'other_name',
    'email', 'is_active'
  ];

  protected $casts = [
      // 'is_active' => 'boolean', 'person_id' => 'int', 'owner_id' => 'int', 'role_id' => 'int',
    'is_active' => 'boolean', 'owner_id' => 'int', 'role_id' => 'int',
  ];

  protected $dates = ['password_updated_at'];

  protected $loggableLabel = 'email';

  protected $loggable = [
    'email',
    'school_id' => [School::class => 'name'],
    'role_id' => [Role::class => 'name'],
  ];

    // public function person()
    // {
    //     return $this->belongsTo(Person::class);
    // }

  public $test = true;

  public function name() {
    return $this->first_name.' '.$this->last_name;
  }

  public function school()
  {
    return $this->belongsTo(School::class);
  }

  public function role()
  {
    return $this->belongsTo(Role::class);
  }

  public function files()
  {
    return $this->hasMany(File::class, 'created_by');
  }

  public function logins()
  {
    return $this->hasMany(Login::class);
  }

  public function preference()
  {
    return $this->hasOne(Preference::class);
  }

  public function isAdmin()
  {
    return $this->role_id === Role::AdminId;
  }

  public function isSupervisor()
  {
    return $this->role_id === Role::SupervisorId;
  }

  public function belongsToAdminGroup1()
  {
    return $this->group_id === UserGroup::AdminGroupId;
  }

    // public function isPerson(Person $person)
    // {
    //     return $this->person_id === $person->id;
    // }

  public function persistDefaultPreferences()
  {
    $this->preference()
      ->save($this->defaultPreferences());
  }

  public function preferences()
  {
    $preferences = $this->preference
      ? $this->preference->value
      : $this->defaultPreferences()->value;

    unset($this->preference);

    return $preferences;
  }

  public function lang()
  {
    return $this->preferences()
      ->global
      ->lang;
  }

  private function defaultPreferences()
  {
    return new Preference([
      'value' => DefaultPreferences::data(),
    ]);
  }

  public function setGlobalPreferences($global)
  {
    $preferences = $this->preferences();
    $preferences->global = $global;

    $this->setPreferences($preferences);
  }

  public function setLocalPreferences($route, $value)
  {
    $preferences = $this->preferences();
    $preferences->local->$route = $value;

    $this->setPreferences($preferences);
  }

  public function delete()
  {
    // if ($this->logins()->first() !== null) {
    //   throw new ConflictHttpException(__(
    //     'The user has activity in the system and cannot be deleted'
    //   ));
    // }

    try {
      parent::delete();
    } catch (\Exception $e) {
      dd($e);
      throw new ConflictHttpException(__(
        'The user has assigned resources in the system and cannot be deleted'
      ));
    }
  }

  private function setPreferences($preferences)
  {
    $this->preference()
      ->updateOrCreate(
        ['user_id' => $this->id],
        ['value' => $preferences]
      );
  }
}
