<?php

namespace LaravelEnso\Core\app\Forms\Builders;

use LaravelEnso\Core\app\Models\User;
use LaravelEnso\FormBuilder\app\Classes\Form;

use App\Traits\CurrentUser;

class UserForm
{
  use CurrentUser;

  private const TemplatePath = __DIR__ . '/../Templates/user.json';
  private const Tooltip = 'Personal information can only be edited via the person form';

  private $form;

  public function __construct()
  {
    $this->form = new Form(self::TemplatePath);
    if(!$this->getCurrentUser()->can('access-route','administration.schools.options')) {
      $this->form->hide('school_id');
    }

  }

  public function create($person)
  {
    $this->setCommonValues($person);

    // if (auth()->user()->can('change-password', $user)) {
      $this->form->show([
        'password', 'password_confirmation',
      ]);
    // }
    return $this->form
          ->value('school_id', $this->getCurrentUser()->school_id)
            // ->value('email', $person->email)
            // ->value('person_id', $person->id)
      ->create();
  }

  public function edit(User $user)
  {
    $this->setCommonValues($user->person);

    if (auth()->user()->can('change-password', $user)) {
      $this->form->show([
        'password', 'password_confirmation',
      ]);
    }

    return $this->form
      ->value('password', null)
            // ->append('personId', $user->person_id)
      ->actions(['back', 'destroy', 'show', 'update'])
      ->edit($user);
  }

  private function setCommonValues($person)
  {
    $this->form
            // ->value('title', $person->title)
            // ->value('name', $person->name)
            // ->value('appellative', $person->appellative)
      ->meta('title', 'tooltip', self::Tooltip)
            // ->meta('name', 'tooltip', self::Tooltip)
            // ->meta('appellative', 'tooltip', self::Tooltip);
            ;
  }
}
