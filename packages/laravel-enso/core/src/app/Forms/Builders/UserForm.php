<?php

namespace LaravelEnso\Core\app\Forms\Builders;

use Illuminate\Http\Request;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\FormBuilder\app\Classes\Form;

use App\Traits\CurrentUser;
use LaravelEnso\Schools\app\Models\School;

class UserForm
{
  use CurrentUser;

  private const TemplatePath = __DIR__ . '/../Templates/';
  private const Tooltip = 'Personal information can only be edited via the person form';

  private $form;

  public function __construct(Request $request)
  {
    // getting template corresponding to the route name (user, student, ...)
    $segments = explode('.', $request->route()->getName());
    $template = self::TemplatePath . substr($segments[1], 0, -1) . '.json';
    $this->form = new Form($template);
    if (!$this->getCurrentUser()->can('access-route', 'administration.schools.options')) {
      $this->form->hide('school_id');
    }
  }

  public function create($person)
  {

    $this->form->show([
      'password', 'password_confirmation',
    ]);

    $school = School::find($this->getCurrentUser()->school_id);
    return $this->form
      ->value('school_id', $school->id)
      ->value('school.dfe', $school->dfe)
      ->create();
  }

  public function edit(User $user)
  {

    if (auth()->user()->can('change-password', $user)) {
      $this->form->show([
        'password', 'password_confirmation',
      ]);
    }

    return $this->form
      ->value('password', null)
      ->value('school.dfe', $user->school->dfe)
      ->actions(['back', 'destroy', 'show', 'update'])
      ->edit($user);
  }

  // private function setCommonValues($user)
  // {
  //   $this->form
  //     ->value('school.dfe', $user->school->dfe)
  //     // ->value('title', $person->title)
  //     // ->value('name', $person->name)
  //     // ->value('appellative', $person->appellative)
  //     // ->meta('title', 'tooltip', self::Tooltip)
  //     // ->meta('name', 'tooltip', self::Tooltip)
  //     // ->meta('appellative', 'tooltip', self::Tooltip);
  //   ;
  // }
}
